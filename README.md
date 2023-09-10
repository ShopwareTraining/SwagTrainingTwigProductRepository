# SwagTrainingTwigProductRepository

**Example plugin to show how you can create a Twig extension that exposes a product repository via Twig (and not looking at the security perspective and/or the esthetical issues with this)**

## Example usage
```twig
{% set criteria = productRepositoryCriteriaWithPrefixFilter('productNumber', 'SWDEMO') %}
{% set items = productRepositorySearch(criteria, context) %}
{% endblock %}
```