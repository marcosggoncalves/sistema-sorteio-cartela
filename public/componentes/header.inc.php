<nav class="navbar navbar-expand-lg bg-success" >
  <div class="container">
    <a class="navbar-brand link-light" href="<?=$_ENV['NAME_PASTA'] ?>"><?= $data['title'] ?></a>
 
    <div class="navbar-text" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link link-light" aria-current="page" href="<?=$_ENV['NAME_PASTA'] ?>/">Sorteio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link link-light" href="<?=$_ENV['NAME_PASTA'] ?>/apostadores">Apostadores</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container mt-2" >
  <div  style="display: none;" role="alert" id="mensagem"></div>
</div>