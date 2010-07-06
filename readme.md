# Kohana Render Contexts

## What?

This module, for the Kohana web application framework, automatically escapes
values fetched from the ORM library using html::specialchars(), but only when
outputting data in a View.

## Why?

When in a controller, you need to be able to do sensible comparisons like so:

    if ($model->field == '<value>') {
        // Do something.
    }

But, when outputting that same value in a view, you don't want to output special
HTML characters and risk XSS etc.

## How?

For now, you must define your models like so:

    class Blog_Post_Model extends Context_ORM {
    }

And also enable hooks in `application/config/config.php`.

If you don't want to use hooks, simply add the following to your root Controller
class's constructor:

    Context_Stack::instance()->push_controller_context();

Also, if your application overrides the standard View class, using
`libraries/MY_View.php`, then you will probably need to copy the
`View->render()` implementation from the module's copy of `MY_View.php` into
your application.

That's it!

## Really?

Well, sort of. Any standard column value retrieved from an Context_ORM instance
will now be an instance of `Context_ORM_Value`, so bear that in mind.

The `Context_ORM_Value` class has a `__toString()` method that will return the
raw value when in a Controller context, and an html-escaped string when in a
view.

If you need access to the raw value from within the view, or the html-escaped
one from within a controller, you can use the following code:

    $raw_value = $model->field->raw_value();
    $html_value = $model->field->html_value();

## Cool!

Hope so. This is just the first version of an idea I had whilst driving home
earlier tonight. Undoubtedly there will be pitfalls I've not considered yet.

## Help!

The code is hosted at github as well as on my private gitorious instance, but
please raise any issues on over on the [github issue tracker][1]:
[1]: http://github.com/Drarok/kohana-render-context/issues