<?php
/**
 * Created by PhpStorm.
 * User: Jérôme
 * Date: 15.09.14
 * Time: 09:01
 */ ?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <section class="container">
        <header class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?php ph($app['title']); ?></a>
        </header>
        <div class="navbar-collapse collapse">
            <form class="navbar-form navbar-right" role="form">
                <div class="form-group">
                    <input type="text" placeholder="Email" class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Password" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">Sign in</button>
            </form>
        </div>
        <!--/.navbar-collapse -->
    </section>
</nav>
