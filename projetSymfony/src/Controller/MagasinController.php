<?php

namespace App\Controller;

use App\Entity\Livres;
use App\Form\LivreType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


#[Route('/magasin', name: 'app_magasin')]
class MagasinController extends AbstractController
{
    #[Route('/listProd', name: '_list')]
    public function index(EntityManagerInterface $em): Response
    {
        $Livresrep = $em->getRepository(Livres::class);
        $Livres = $Livresrep->findAll();
        $args = array(
            'Livres' => $Livres
        );
        return $this->render('magasin/list.html.twig',$args);
    }
    #[Route('/viewProd/{id}',
        name : '_view',
        requirements: ['id' => '[1-9]\d*'],
    )]
    public function viewLivre(int $id, EntityManagerInterface $em): Response
    {
        $livrerep = $em->getRepository(Livres::class);
        $livre = $livrerep->find($id);
        $args = array(
            'livre' => $livre,
            'id' => $id,
        );
        return $this->render('magasin/view.html.twig',$args);
    }
    #[Route('/add',
        name : '_add',
    )]
    public function addLivre(EntityManagerInterface $em,Request $request): Response
    {
        $livre = new Livres();

        $form = $this->createForm(LivreType::class, $livre);
        $form->add('send', SubmitType::class, ['label' => 'add livre']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($livre);
            $em->flush();
            $this->addFlash('info', 'ajout livre réussi');
            return $this->redirectToRoute('app_magasin_view', ['id' => $livre->getId()]);
        }

        if ($form->isSubmitted())
            $this->addFlash('info', 'formulaire ajout livre incorrect');

        $args = array(
            'formlivre' => $form->createView(),
        );
        return $this->render('magasin/addLivre.html.twig', $args);
    }
    #[Route(
        '/delete/{id}',
        name: '_delete',
        requirements: ['id' => '[1-9]\d*'],
    )]
    public function deleteAction(int $id, EntityManagerInterface $em): Response
    {
        $livreRepository = $em->getRepository(Livres::class);
        $livre = $livreRepository->find($id);
        if (is_null($livre))
        {
            $this->addFlash('info', 'suppression livre ' . $id . ' : échec');
            throw new NotFoundHttpException('livre ' . $id . ' inconnu');
        }

        $em->remove($livre);      // le paramètre est l'objet et non pas l'id
        $em->flush();
        $this->addFlash('info', 'suppression livre ' . $id . ' réussie');

        return $this->redirectToRoute('app_magasin_list');
    }
    #[Route(
        '/edit/{id}',
        name: '_edit',
        requirements: ['id' => '[1-9]\d*'],
    )]
    public function EditAction(int $id, EntityManagerInterface $em, Request $request): Response
    {
        $livreRepository = $em->getRepository(Livres::class);
        $livre = $livreRepository->find($id);

        if (is_null($livre))
            throw new NotFoundHttpException('livre ' . $id . ' inexistant');

        $form = $this->createForm(LivreType::class, $livre);
        $form->add('send', SubmitType::class, ['label' => 'edit livre']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em->flush();
            $this->addFlash('info', 'édition livre réussie');
            return $this->redirectToRoute('app_magasin_view', ['id' => $livre->getId()]);
        }

        if ($form->isSubmitted())
            $this->addFlash('info', 'formulaire livre incorrect');

        $args = array(
            'myform' => $form->createView(),
        );
        return $this->render('magasin/edit.html.twig', $args);
    }
}
