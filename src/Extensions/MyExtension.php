<?php
namespace MyTheme\Extensions;

use Plenty\Plugin\Templates\Extensions\Twig_Extension;
use Plenty\Plugin\Templates\Factories\TwigFactory;
use Plenty\Modules\Item\Item\Contracts\ItemRepositoryContract;


class MyExtension extends Twig_Extension
{

    private $factory;
    private $itemContract;

    public function __construct(TwigFactory $factory,  ItemRepositoryContract $contract  )
    {
        $this->factory = $factory;
        $this->itemContract = $contract;
    }

    public function getName(): string
    {
        return "theme_extension";
    }

    public function getFunctions(): array
    {
      return [
        $this->factory->createSimpleFunction('getFree', [$this, 'getFree'])
      ];
    }

    public function getFree(int $itemID)
    {
      $result = $this->itemContract->show($itemID);
      return $result;
    }
}
