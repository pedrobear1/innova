<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use AppBundle\Entity\Product;
use AppBundle\Entity\Category;
use AppBundle\Entity\Project;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     * 
     */
    public function indexAction(Request $request) {
        return $this->render('innova/home.html.twig');
    }

    /**
     * @Route("/products", name="products")
     * 
     */
    public function productShowAction() {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
        $all_categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        
        $currentTab = null;

        return $this->render('innova/products.html.twig', ['products' => $products, 'all_categories' => $all_categories, 'current_tab' => $currentTab]);
    }

    /**
     * @Route("/products/{category}", name="products_filtered")
     * 
     */
    public function productFilteredShowAction($category) {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("SELECT p from AppBundle\Entity\Product p JOIN p.category c WHERE c.id = :category");
        $query->setParameter('category', $category);
        $products = $query->getResult();
        $all_categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        
        $currentTab = $category;


        return $this->render('innova/products.html.twig', ['products' => $products, 'all_categories' => $all_categories, 'current_tab' => $currentTab]);
    }
    
    
      /**
     * @Route("/product/{id}", name="product")
     * 
     */
    public function productAction($id) {
        $product = $this->getDoctrine()->getRepository(Product::class)->findOneBy(array('id' => $id));

        return $this->render('innova/product.html.twig', ['product' => $product]);
    }
    

    /**
     * @Route("/gallery", name="gallery")
     */
    public function galleryAction() {
        $projects = $this->getDoctrine()->getRepository(Project::class)->findAll();
        return $this->render('innova/gallery.html.twig', ['projects' => $projects]);
    }

    /**
     * @Route("/contact", name="contact")
     * 
     */
    public function contactAction(Request $request) {

        $form = $this->createForm('AppBundle\Form\ContactType', null, array(
            'action' => $this->generateUrl('contact'),
            'method' => 'POST'
        ));

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $data = $form->getData();
                if ($this->sendEmail($data)) {
                    $this->addFlash('success', 'Tu correo se ha enviado correctamente');
                    return $this->redirectToRoute('contact');
                } else {
                    $this->addFlash('danger', 'Ha ocurrido un error en el envio del mensaje');
                }
            }
        }
        return $this->render('innova/contact.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    private function sendEmail($data) {
        $myContactMail = 'dev.pepicast@gmail.com';

        $message = \Swift_Message::newInstance()
                ->setSubject($data["subject"])
                ->setFrom(array($data["email"] => $data["name"]))
                ->setTo(array(
                    $myContactMail => $myContactMail
                ))
                ->setBody($this->renderView('mail/sendmail.html.twig', array(
                    'message' => $data["message"],
                    'email' => $data["email"]
                )), 'text/html');

        return $this->get('mailer')->send($message);
    }

}
