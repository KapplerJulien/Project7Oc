<?php

namespace App\DataFixtures;

use App\Entity\Company;
use App\Entity\Phone;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $roles[] = 'ROLE_USER';
        $numUser = 0;

        for($numCompany = 0; $numCompany < 5; $numCompany++){

            $company = new Company();
            $companyInfo = array(
                'Name' => array('Locami', 'Vreelodie', 'Greffoldy', 'Crompangie', 'Polcaloid'),
                'City' => array('Marseille', 'Paris', 'Montpellier'),
                'ZipCode' => array('13000', '75000', '34000'),
                'Address' => array('Rue de la lionne', 'Avenue des beaux arts', 'Route du sanctuaire'),
                'Address2' => array('Chemin des mimosas', 'Chemin de Victor Hugo', 'Chemin de la rivière')
            );
            $infoRand = mt_rand(0,2); 
            $companyName = $companyInfo['Name'][$numCompany];
            $company->setRoles($roles);
            $company->setUsername($companyName);
            $encoded = $this->encoder->encodePassword($company, $plainPassword);
            $company->setPassword($encoded);
            $company->setNameCompany($companyName);
            $company->setAddressCompany($companyInfo['Address'][$infoRand]);
            $company->setAddress2Company($companyInfo['Address2'][$infoRand]);
            $company->setFloorCompany((string)mt_rand(0,4));
            $company->setZipCodeCompany($companyInfo['ZipCode'][$infoRand]);
            $company->setCityCompany($companyInfo['City'][$infoRand]);
            $company->setPhoneCompany((int)('0'.(string)mt_rand(600000000,699999999)));
            $company->setMailCompany($companyName."@gmail.com");
            $manager->persist($company);


            for($i = 0; $i < 8; $i++){
                $user = new User();
                $nameUser = array(
                    'Name' => array('Jean', 'Alice', 'Patrick', 'Lola', 'Paul', 'Jule', 'Marie', 'Molie'),
                    'LastName' => array('Huart', 'Loidea', 'kifred', 'Polais', 'Maldonie', 'Palsoie', 'Valosive', 'Nefrolde')
                );
                $userName = $nameUser['Name'][mt_rand(0,7)];
                $userLastName = $nameUser['LastName'][mt_rand(0,7)];
                $user->setUsername($userName.(string)$numUser);
                $user->setNameUser($userName);
                $user->setLastNameUser($userLastName);
                $user->setMailUser($userLastName.".".$userName."@gmail.com");
                $user->setCompany($company);
                $manager->persist($user);

                $phone = new Phone();
                
                $namePhone = array(
                    'IPhone' => array('IPhone 12', 'IPhone 11 Pro', 'IPhone 8', 'IPhone SE', 'IPhone XR', 'IPhone XS'),
                    'Samsung' => array('Galaxy A51', 'Galaxy A12', 'J7', 'J5', 'Galaxy S9', 'Galaxy S10 Plus'),
                    'Xiaomi' => array('Redmi note 9', 'Redmi note 10', 'redmi note 8', 'Mi 10T', 'Mi 11', 'Mi 10T Lite'),
                    'Huawei' => array('P30 Pro', 'P Smart', 'Y6', 'P20', 'P40', 'Honor 8'),
                );
                $brandPhone = array('IPhone', 'Samsung', 'Xiaomi', 'Huawei');
                $colorPhone = array('Rouge', 'Noir', 'Violet', 'Jaune', 'Bleu', 'Rose', 'Vert', 'Marron');
                $brandChoice = $brandPhone[mt_rand(0,3)];

                $phone->setNamePhone($namePhone[$brandChoice][mt_rand(0,5)]);
                $phone->setColorPhone($colorPhone[mt_rand(0,7)]);
                $phone->setQuantityPhone(mt_rand(50,200));
                $phone->setPricePhone(mt_rand(100,1000));
                $phone->setBrandPhone($brandChoice);
                $phone->setUser($user);

                $numUser ++;

                $manager->persist($phone);
            }
        }

        $manager->flush();
    }
}
