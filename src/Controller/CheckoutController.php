<?php

namespace App\Controller;

use App\Entity\Order;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CheckoutController extends AbstractController
{   
    #[Route('/admin/checkout', name: 'app_checkout',methods:['GET','POST'])]
    public function checkout(Request $request,EntityManagerInterface $entityManager,Security $security): Response
    {
        // Получаем сессию и данные корзины
        $cart = $request->getSession()->get('cart', []);

        // Создаем форму для оформления заказа
        $form = $this->createFormBuilder()
            ->add('name', TextType::class, ['label' => 'Имя'])
            ->add('email', TextType::class, ['label' => 'E-mail'])
            ->add('phone', TextType::class, ['label' => 'Телефон'])
            ->add('address', TextType::class, ['label' => 'Address'])
            ->add('status', ChoiceType::class, [
                'choices'  => [
                'New' => 'new',
                'In Progress' => 'in_progress',
                'Done' => 'done',
                ],
            ])
            ->add('paymentMethod', ChoiceType::class, [
                'label' => 'Choose a payment method',
                'choices' => [
                    'Credit Card' => 'credit_card',
                    'PayPal' => 'paypal',
                    'Apple Pay' => 'apple_pay',
                    'Google Pay' => 'google_pay',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('notes', TextType::class, ['label' => 'Notes'])
            ->getForm();

        // Обрабатываем отправку формы
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();

            $order = new Order();
            $order->setCustomerName($formData['name']);
            $order->setCustomerEmail($formData['email']);
            $order->setCustomerPhone($formData['phone']);
            $order->setUser($security->getUser());
            $order->setItems($cart);
            /*$total = 0; 

                foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity']; 
                    }*/
            $order->setTotalPrice($order->calculateTotalPrice($cart));
            $order->setStatus($formData['status']);
            $order->setDeliveryAddress($formData['address']);
            $order->setPaymentMethod($formData['paymentMethod']);
            $order->setNotes($formData['notes']);



            $entityManager->persist($order);
            $entityManager->flush();

            // Очищаем корзину
            $request->getSession()->set('cart', []);

            // Выводим страницу с подтверждением заказа
            return $this->render('admin/checkout/confirmation.html.twig');
        }

        // Выводим форму оформления заказа и список продуктов в корзине
        return $this->render('admin/checkout/checkout.html.twig', [
            'cart' => $cart,
            'form' => $form->createView(),
        ]);
    }
}
