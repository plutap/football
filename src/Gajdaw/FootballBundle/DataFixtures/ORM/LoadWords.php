<?php

namespace My\MountainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gajdaw\FootballBundle\Entity\Word;
use Symfony\Component\Yaml\Yaml;

class LoadWords implements FixtureInterface
{
    function load(ObjectManager $manager)
    {
        $filename =
            __DIR__ .
                DIRECTORY_SEPARATOR . '..' .
                DIRECTORY_SEPARATOR . '..' .
                DIRECTORY_SEPARATOR . 'Data/words.yml';

        $yml = Yaml::parse(file_get_contents($filename));
        foreach ($yml as $w) {
            $Word = new Word();
            $Word->setName($w['name']);
            $manager->persist($Word);
        }
        $manager->flush();
    }
}
