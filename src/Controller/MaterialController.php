<?php

namespace App\Controller;

use App\Entity\Material;
use App\Repository\MaterialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MaterialController extends AbstractController
{
    /**
     * @Route("/material/{id}", name="show_material")
     */
    public function index(MaterialRepository $materialRepository, int $id)
    {
        $material = $materialRepository->find($id);

        return $this->render('material/show.html.twig', [
            'material' => $material
        ]);
    }
}
