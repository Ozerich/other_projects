<header>
    <h1><?=$name?></h1>
</header>

<section class="middle">

    <p class="inf"><?=$text?></p>

    <div class="calculation">
        <form action="#" method="post">

            <input type="hidden" name="type" value="<?=$_GET['type']?>"/>
            <input type="hidden" name="calculator" value="<?=$_GET['calculator']?>"/>