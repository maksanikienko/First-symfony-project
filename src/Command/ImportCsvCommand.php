<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use App\Entity\Product;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Input\InputArgument;

#[AsCommand(
    name: 'import-csv',
    description: 'Add a short description for your command',
)]
class ImportCsvCommand extends Command
{
    
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            
            ->setHelp('This command allows you to import products from a CSV file')
            ->addArgument('filename', InputArgument::REQUIRED, 'The name of the CSV file');
        
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $filePath = $input->getArgument('filename');

        if (!file_exists($filePath)) {
            $io->error('File not found: ' . $filePath);
            return Command::FAILURE;
        }
        
        $csvData = array_map(str_getcsv(...), file($filePath));

        if (count($csvData) < 2) {
            $io->error('CSV file is empty or contains only headers');
            return Command::FAILURE;
        }

        $headers = $csvData[0];
        unset($csvData[0]);

        foreach ($csvData as $row) {
            $data = array_combine($headers, $row);

            $product = new Product();
            $product->setId($data['ID']);
            $product->setName($data['Name']);
            $product->setPrice($data['Price']);
            $product->setDescription($data['Description']);
            $product->setBrand($data['Brand']);
            $product->setAvailability($data['Availability']);
            $product->setNumber($data['Number']);
            

            $this->entityManager->persist($product);
        }

        $this->entityManager->flush();

        $io->success('Products imported successfully');

        return Command::SUCCESS;
    }
}
