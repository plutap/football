<?php

namespace Gajdaw\FootballBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Gajdaw\FootballBundle\Entity\League;
use Symfony\Component\Yaml\Yaml;

class LoadConference implements FixtureInterface
{
    function load(ObjectManager $manager)
    {
        $filename =
            __DIR__ .
                DIRECTORY_SEPARATOR . '..' .
                DIRECTORY_SEPARATOR . '..' .
                DIRECTORY_SEPARATOR . 'Data/league.yml';

        $yml = Yaml::parse(file_get_contents($filename));
        foreach ($yml as $item) {
            $league = new League();
            $league->setName($item['name']);
            $league->setCountry($item['country']);
            $manager->persist($league);
        }
        $manager->flush();

    }
}