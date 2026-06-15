<?php

namespace App\DataFixtures;

use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $video = new Video();
            $video->setTitle("Test Video {$i}");
            $video->setDescription("This is the description for test video {$i}.");
            $video->setUrl("https://example.com/video{$i}.mp4");
            $video->setCreatedAt(new \DateTime());

            $manager->persist($video);
        }

        $manager->flush();
    }
}
