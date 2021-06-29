# Templating

## Pages
To create a page, create a new Twig file in `templates/pages` folder.

In the page template, extend `base.html.twig` like so:

```twig
{% extends 'base.html.twig' %}
```

Remember to set the page ID variable after extending the base template:

```twig
{% set pageId = 'home' %}
```

## Wrappers

Wrappers should be used to wrap any content to show it correctly and in a responsive manner. Also, a row with a corresponding column should always be used inside a wrapper for correct usage.

```twig
{% embed 'snippets/wrapper.html.twig' %}
    {% block content %}
        {% embed 'snippets/row.html.twig' %}
            {% block content %}
                {% embed 'snippets/col.html.twig' %}
                    {% block content %}
                        Responsive content
                    {% endblock %}
                {% endembed %}
            {% endblock %}
        {% endembed %}
    {% endblock %}
{% endembed %}
```

## Grid

The grid system actually plays an important role throughout the entire structure of the UI. All content should be placed within a wrapper, a row and a column. To make elements sit next to each other and wrap in a responsive manner requires just one small additional step.

A simple responsive column looks like this:

```twig
{% embed 'snippets/col.html.twig' with {
    xs: 12,
    sm: 6,
    md: 4,
    lg: 3
} %}
    {% block content %}
        Responsive content
    {% endblock %}
{% endembed %}
```

By adding values for `xs`, `sm`, `md` and `lg` you can define at which breakpoints the columns should change their size, and you can specify exactly what size you'd want them to be.
To create a full width column (which you will need for all content you want to be within a wrapper without having side-by-side elements), you can just not pass any values to `col.html.twig`. It will default to a full width column by itself.
