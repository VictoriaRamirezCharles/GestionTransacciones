<?php

class Layout
{
  private $isRoot;
  private $directory;

  function __construct($page)
  {
    $this->isRoot = $page;
    $this->directory = ($this->isRoot) ? "../": "";
  }

  public function printHeader()
  {
    $header = <<<EOF
      <!DOCTYPE html>
      <html lang="en"><head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
          <title>Gestion Transacciones</title>
          
      <link rel="stylesheet" href="{$this->directory}assets\css\bootstrap.min.css" type="text/css">
      <link rel="stylesheet" href="{$this->directory}assets\css\style.css"  type="text/css">
      </head>
      
        <body>
          <header>
        <div class="collapse bg-dark" id="navbarHeader">
        
          </div>
        </div>
        <div class="navbar navbar-dark bg-dark shadow-sm">
          <div class="container d-flex justify-content-between">
            <a href="{$this->directory}Index.php" class="navbar-brand d-flex align-items-center">
              <strong><i class="far fa-address-book"></i> Gestion Transacciones</strong>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          </div>
        </div>
      </header>
    EOF;
    echo $header;
  }

  public function printFooter()
  {
    $footer = <<<EOF
      <footer class="footer">
 
      </footer>
      <script src="{$this->directory}assets/js/jquery/jquery-3.5.1.min.js"></script>
      <script src="{$this->directory}assets\js\bootstrap.min.js"></script>
    
      </body>
      </html>
    EOF;
    echo $footer;
  }
} 

?>