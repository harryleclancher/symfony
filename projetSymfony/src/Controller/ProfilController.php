<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Request;


#[Route('/profil', name: 'app_profil')]
class ProfilController extends AbstractController
{
    #[Route('/list', name: '_list')]
    public function index(EntityManagerInterface $em): Response
    {
        $profilrep = $em->getRepository(User::class);
        $Profils = $profilrep->findAll();
        $args = array(
            'Profils' => $Profils
        );
        return $this->render('profil/list.html.twig',$args);
    }
    #[Route('/view/{id}',
    name : '_view',
    requirements: ['id' => '[1-9]\d*'],
)]
    public function viewProfil(int $id, EntityManagerInterface $em): Response
    {
        $profilrep = $em->getRepository(User::class);
        $profil = $profilrep->find($id);
        $args = array(
            'profil' => $profil,
            'id' => $id,
        );
        return $this->render('profil/view.html.twig',$args);
    }
    #[Route(
        '/delete/{id}',
        name: '_delete',
        requirements: ['id' => '[1-9]\d*'],
    )]
    public function deleteAction(int $id, EntityManagerInterface $em): Response
    {
        $ProfilRepository = $em->getRepository(User::class);
        $profil = $ProfilRepository->find($id);
        if (is_null($profil))
        {
            $this->addFlash('info', 'suppression profil ' . $id . ' : échec');
            throw new NotFoundHttpException('profil ' . $id . ' inconnu');
        }

        $em->remove($profil);      // le paramètre est l'objet et non pas l'id
        $em->flush();
        $this->addFlash('info', 'suppression profil ' . $id . ' réussie');

        return $this->redirectToRoute('app_profil_list');
    }
    #[Route(
        '/edit/{id}',
        name: '_edit',
        requirements: ['id' => '[1-9]\d*'],
    )]
    public function EditAction(int $id, EntityManagerInterface $em, Request $request): Response
    {
        $profilRepository = $em->getRepository(User::class);
        $profil = $profilRepository->find($id);

        if (is_null($profil))
            throw new NotFoundHttpException('profil ' . $id . ' inexistant');

        $form = $this->createForm(UserType::class, $profil);
        $form->add('send', SubmitType::class, ['label' => 'edit profil']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em->flush();
            $this->addFlash('info', 'édition profil réussie');
            return $this->redirectToRoute('app_profil_view', ['id' => $profil->getId()]);
        }

        if ($form->isSubmitted())
            $this->addFlash('info', 'formulaire profil incorrect');

        $args = array(
            'myform' => $form->createView(),
        );
        return $this->render('profil/edit.html.twig', $args);
    }
    #[Route('/add',
        name : '_add',
    )]
    public function addProfil(EntityManagerInterface $em,Request $request): Response
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        $form->add('send', SubmitType::class, ['label' => 'add_user']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($user);
            $em->flush();
            $this->addFlash('info', 'ajout livre réussi');
            return $this->redirectToRoute('app_profil_view', ['id' => $user->getId()]);
        }

        if ($form->isSubmitted())
            $this->addFlash('info', 'formulaire ajout  user incorrect');

        $args = array(
            'formUser' => $form->createView(),
        );
        return $this->render('magasin/addUser.html.twig', $args);
    }
}
