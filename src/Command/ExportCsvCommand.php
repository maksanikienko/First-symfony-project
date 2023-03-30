<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Repository\ProductRepository;

#[AsCommand(
    name: 'export-csv',
    description: 'Add a short description for your command',
)]
class ExportCsvCommand extends Command
{
    public function __construct(protected ProductRepository $productRepository){
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
        ->setName('app:export-csv')
        ->setDescription('Exports all products to a CSV file')
        ->addArgument('filename', InputArgument::REQUIRED, 'The name of the CSV file');
        
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filename = $input->getArgument('filename');

      
    
        // Получаем все объекты Product из базы данных
        $products = $this->productRepository->findAll();
    
        // Открываем файл для записи
        $fp = fopen($filename, 'w');
    
        // Записываем заголовок CSV
        fputcsv($fp, ['ID', 'Name', 'Price','Description','Brand','Availabelity','Number']);
    
        // Записываем каждый объект Product в CSV
        foreach ($products as $product) {
            fputcsv($fp, [$product->getId(), $product->getName(), $product->getPrice(),$product->getDescription(),$product->getBrand(),$product->isAvailability(),$product->getNumber()]);
        }
    
        // Закрываем файл
        fclose($fp);
    
        $output->writeln('Products exported to ' . $filename);
        return Command::SUCCESS;
    }
}
