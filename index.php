<?php

    include ('vendor/autoload.php');

?>

<!DOCTYPE html>

<html>

<head>
    <title>Hyperlight Demo</title>
     <link rel="stylesheet" type="text/css" href="vibrant-ink.css" />
</head>

<body>
    <h1>Hyperlight Demo</h1>

    <h2>PHP</h2>

<pre class="source-code php">
<?php

    $hyperlight = new Hyperlight\Hyperlight ('php');
    print $hyperlight->render (<<<'EOT'
<div class="foobar">
<?php
    if ($expr == true)
        echo ('this is php code')
    else
        $value = array ("string", 1337);
?>
</div>
EOT
    );

?>
</pre>

    <h2>Javascript</h2>

<pre class="source-code javascript">
<?php

    $hyperlight = new Hyperlight\Hyperlight ('javascript');
    print $hyperlight->render (<<<'EOT'
$('#btnSlideUp').click (function ()
{
    $('#slideMe').slideUp ('slow');
});

$('#btnSlideDown').click (function()
{
    $('#slideMe').slideDown(400);
});
EOT
    );

?>
</pre>

    <h2>CSS with LESS</h2>

<pre class="source-code css">
<?php

    $hyperlight = new Hyperlight\Hyperlight ('css');
    print $hyperlight->render (<<<'EOT'
.wrapper.light
{
    background: #eee;
}

.grid-wrapper
{
    background: #fff;
}

.margin-flow()
{
    margin-top: @line_size;
    margin-bottom: @line_size;

    &:first-child
    {
        margin-top: 0;
    }

    &:last-child
    {
        margin-bottom: 0;
    }
}
EOT
    );
?>
</pre>

    <h2>Twig templates</h2>

<pre class="source-code twig">
<?php

    $hyperlight = new Hyperlight\Hyperlight ('twig');
    print $hyperlight->render (<<<'EOT'
{% extends "layout.html" %}

{% block content %}

<ul class="users">

    {% for user in users %}
        <li>{{ user.name }}</li>
    {% else %}
        <li>No users have been found.</li>
    {% endfor %}

</ul>

{% endblock %}
EOT
    );

?>
</pre>

</body>

</html>
