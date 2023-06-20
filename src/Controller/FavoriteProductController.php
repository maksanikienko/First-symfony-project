<?php
  
  namespace App\Controller;
  
  use App\Entity\FavoriteProduct;
  use App\Repository\ProductRepository;
  use Doctrine\ORM\EntityManagerInterface;
  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
  use Symfony\Component\HttpFoundation\JsonResponse;
  use Symfony\Component\Routing\Annotation\Route;
  
  class FavoriteProductController extends AbstractController
  {
      protected $entityManager;
      protected $productRepository;
  
      public function __construct(EntityManagerInterface $entityManager, ProductRepository $productRepository,)
      {
          $this->entityManager = $entityManager;
          $this->productRepository = $productRepository;
      }
  
      #[Route('/favorite/add/{productId}', name: 'favorite_add', methods: ['POST'])]
      public function addToFavorite( int $productId): JsonResponse
      {
          // Получаем текущего пользователя (предполагается, что у вас настроена аутентификация)
          $user = $this->getUser();
  
          // Получаем продукт по его идентификатору
          $product = $this->productRepository->find($productId);
  
          // Проверяем, является ли продукт уже избранным для данного пользователя
          $isFavorite = $this->entityManager->getRepository(FavoriteProduct::class)->findOneBy([
              'client' => $user,
              'product' => $product,
          ]);
  
          // Если продукт уже в списке избранных, возвращаем сообщение об ошибке
          if (!$isFavorite) {
             // Создаем новый экземпляр FavoriteProduct
          $favoriteProduct = new FavoriteProduct();
          $favoriteProduct->setClient($user);
          $favoriteProduct->setProduct($product);
  
          // Сохраняем FavoriteProduct в базе данных
          $this->entityManager->persist($favoriteProduct);
          $this->entityManager->flush();

          return $this->json($favoriteProduct,200,[], context: [ 'groups' => ['fav_product']]);

          }
        }
         
      #[Route('/favorite/list', name: 'favorite_list', methods: ['GET'])]
      public function showFavorite( ): JsonResponse
      {
      $allFavoriteProduct = $this->entityManager->getRepository(FavoriteProduct::class)->findAll();
          
      return $this->json($allFavoriteProduct,200,[], context: [ 'groups' => ['fav_product']]);
  }
  }
  