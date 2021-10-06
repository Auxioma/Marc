<?php

namespace App\Controller\Admin;

use DateTime;
use DateInterval;
use App\Entity\Announcement;
use App\Repository\UsersRepository;
use Symfony\Component\Mime\Address;
use App\Repository\AnnouncementRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    private $Users;
    private $Announcement;

    public function __construct(UsersRepository $Users, AnnouncementRepository $Announcement)
    {
        $this->Users = $Users;
        $this->Announcement = $Announcement;
    }
    
    /**
     * @Route("/admin", name="admin_dashboard")
     */
    public function index(): Response
    {
        
        // dd($this->Announcement->ViewAnnoncementAdminForValidation());
        /*$day1 = new \DateTime('now');
        $day2 = new \DateTime('now');
        $day3 = new \DateTime('now');
        $day4 = new \DateTime('now');
        $day5 = new \DateTime('now');
        $day6 = new \DateTime('now');
        $day7 = new \DateTime('now');
        $P1D = $day1->sub(new DateInterval('P1D'));
        $P2D = $day2->add(new DateInterval('P2D'));
        $P3D = $day3->add(new DateInterval('P3D'));
        $P4D = $day4->add(new DateInterval('P4D'));
        $P5D = $day5->add(new DateInterval('P5D'));
        $P6D = $day6->add(new DateInterval('P6D'));
        $P7D = $day7->add(new DateInterval('P7D'));
        $P1DAYS = $this->Announcement->WidgetDashBoardCAAnnonce($P1D);*/

        return $this->render('admin/dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            'users' => $this->Users->AdminListUserAdmin(),
            'annoucement' => $this->Announcement->ViewAnnoncementAdminForValidation(),


        ]);
    }

    /**
     * @Route("/admin/ValiderModifierRefuserAnnonce/{id}/{ids}", name="admin_ValiderModifierRefuserAnnonce")
     */
    public function ValiderModifierRefuserAnnonce($id, $ids, MailerInterface $mailer): Response
    {
        $entityManager   = $this->getDoctrine()->getManager();
        $annonce  = $entityManager->getRepository(Announcement::class)->find($ids);

        if (!$annonce) {
            throw $this->createNotFoundException(
                'No product found for id ' . $ids
            );
        }

        $annonce->setIsVerified($id);
        $entityManager->flush();

        if ($id = '0') {
            $email = (new TemplatedEmail())
            ->from(new Address('no-reply@zimboo.ch', 'Zimboo'))
            ->to('guillaume2vo@yandex.ru')
            ->subject('Votre annonce a été valider')
            ->htmlTemplate('admin/email/validation_annonce.html.twig')
            ->context([
                // 'Message' => $ContactForm->getData('Message'),
            ]);
            $mailer->send($email);
        }        
        if ($id = '1') {
            $email = (new TemplatedEmail())
            ->from(new Address('no-reply@zimboo.ch', 'Zimboo'))
            ->to('guillaume2vo@yandex.ru')
            ->subject('Votre annonce a été valider')
            ->htmlTemplate('admin/email/validation_annonce.html.twig')
            ->context([
                // 'Message' => $ContactForm->getData('Message'),
            ]);
            $mailer->send($email);
        }
        if ($id = '2') {
            $email = (new TemplatedEmail())
            ->from(new Address('no-reply@zimboo.ch', 'Zimboo'))
            ->to('guillaume2vo@yandex.ru')
            ->subject('Votre annonce a été valider')
            ->htmlTemplate('admin/email/validation_annonce.html.twig')
            ->context([
                // 'Message' => $ContactForm->getData('Message'),
            ]);
            $mailer->send($email);
        }
        return $this->redirectToRoute('admin_dashboard');
    }
}
