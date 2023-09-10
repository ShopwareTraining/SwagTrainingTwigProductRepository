<?php declare(strict_types=1);

namespace SwagTraining\TwigProductRepository\Twig;

use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\EntitySearchResult;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\PrefixFilter;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigProductRepository extends AbstractExtension
{
    public function __construct(
        private EntityRepository $productRepository
    ) {
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('productRepositoryCriteriaWithPrefixFilter', [$this, 'productRepositoryCriteriaWithPrefixFilter']),
            new TwigFunction('productRepositorySearch', [$this, 'productRepositorySearch']),
        ];
    }

    /**
     * @return Criteria
     */
    public function productRepositoryCriteriaWithPrefixFilter(string $field, string $value): Criteria
    {
        $criteria = new Criteria;
        $criteria->addFilter(new EqualsFilter('active', true));
        $criteria->addFilter(new PrefixFilter($field, $value));
        return $criteria;
    }

    /**
     * @param Criteria $criteria
     * @param SalesChannelContext $salesChannelContext
     * @return EntitySearchResult
     */
    public function productRepositorySearch(Criteria $criteria, SalesChannelContext $salesChannelContext)
    {
        return $this->productRepository->search($criteria, $salesChannelContext->getContext());
    }
}
