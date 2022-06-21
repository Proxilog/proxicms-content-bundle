<?php

namespace ProxiCMS\ContentBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use ProxiCMS\ContentBundle\Entity\Content;

class ContentFixtures extends Fixture
{
    public const TOTAL = 4; // Nombre total de new Content (à adapter suivant le contenu ci-dessous)
    public const PUBLIC_SLUG = 'backend_index_text';
    public const PRIVATE_SLUG = 'app_email_recipient';

    public function load(ObjectManager $manager): void
    {
        $content = new Content('app_email_recipient', 'Email destination des notifications', 'example@proxicms.com');
        $manager->persist($content);

        $content = new Content('app_main_telephone', 'Téléphone', '01 01 01 01 01');
        $content->setPublic(true);
        $manager->persist($content);

        $content = new Content('subscription_terms_text', 'Inscription - CGV', '<p>inscription - CGV</p>');
        $content->setTextEditor(true);
        $content->setPublic(true);
        $manager->persist($content);

        $content = new Content('backend_index_text', 'Backend - Texte Intro', '<p class="lead mb-4">Le texte en lead. </p>');
        $content->setTextEditor(true);
        $content->setPublic(true);
        $manager->persist($content);

        $manager->flush();
    }
}
