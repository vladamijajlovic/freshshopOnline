<?php 
    
    $range = 5;
    $start = !empty($_GET['start']) ? intval($_GET['start']) : 0;
    $search = !empty($_GET['search']) ? $_GET['search'] : null;

    if (empty($search)) {
        $query = $conn->prepare('SELECT * FROM slika_artikal sa INNER JOIN artikal a ON a.id_artikal = sa.artikal_id INNER JOIN slika s ON s.id_slika = sa.slika_id LIMIT :start, :range');    
    } else {
        $query = $conn->prepare('SELECT * FROM slika_artikal sa INNER JOIN artikal a ON a.id_artikal = sa.artikal_id INNER JOIN slika s ON s.id_slika = sa.slika_id WHERE a.naziv LIKE :search LIMIT :start, :range');
        $bindSearch = "%" .  $search . "%";
        $query->bindParam(":search", $bindSearch);
    }

    
    $query->bindParam(":start", $start, PDO::PARAM_INT);
    $query->bindParam(":range", $range, PDO::PARAM_INT);

   try {
        $query->execute();
        $rezultat = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        var_dump('Greska: ', $exception->getMessage(), "\n"); die;
    }

    //Ovo treba srediti, ako imamo where klauzulu, onda count nece biti isti. if(empty(search))
    $query = $conn->prepare("SELECT COUNT(*) AS artikliCount FROM artikal");

    $exec = $query->execute();
    $count = $query->fetchAll(PDO::FETCH_ASSOC);

    $max = intval($count[0]["artikliCount"]);
    $min = 0;

    $previous = $start - $range;
    $next = $start + $range;

    if ($previous < $min) $previous = $min;
    if ($next >= $max) $next = $max - $range;

    if (empty($search)) {
        $previousLink = BASE_URL."index.php?page=shop&start=".$previous;
        $nextLink = BASE_URL."index.php?page=shop&start=".$next;
    } else {
        $previousLink = BASE_URL."index.php?page=shop&start=".$previous."&search=".$search;
        $nextLink =  BASE_URL."index.php?page=shop&start=".$next."&search=".$search;
    }

 ?>


<!-- Start All Title Box -->
<div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Shop</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Shop</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Shop Page  -->
    <div class="shop-box-inner">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-9 col-sm-12 col-xs-12 shop-content-right">
                    <div class="right-product-box">
                        <div class="product-item-filter row">
                            <div class="col-12 col-sm-8 text-center text-sm-left"></div>
                            <div class="col-12 col-sm-4 text-center text-sm-right">
                                <ul class="nav nav-tabs ml-auto">
                                    <li>
                                        <a class="nav-link active" href="#grid-view" data-toggle="tab"> <i class="fa fa-th"></i> </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="#list-view" data-toggle="tab"> <i class="fa fa-list-ul"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="product-categorie-box">
                            
                            <div class="tab-content">

                                <div id="single-article" role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                    <div class="row">

                                        <?php
                                        foreach ($rezultat as $keyArtikal => $itemArtikal):

                                            $img = BASE_URL . 'images/artikli/' . $itemArtikal['putanja'];
                                        ?>

                                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                            <div class="products-single fix">
                                                <div class="box-img-hover">
                                                    <div class="type-lb">
                                                        <?php if(!empty($itemArtikal['promocije'])): ?>
                                                            <p class="sale"> <?php echo $itemArtikal['promocije']; ?></p>
                                                        <?php else: ?>
                                                            <?php echo '';?>
                                                        <?php endif;?>
                                                    </div>

                                                    <img 
                                                        src="<?php echo $img ?>" 
                                                        class="img-fluid" 
                                                        alt="<?php echo $itemArtikal['alt'] ?>"
                                                    >

                                                    <div class="mask-icon">
                                                        <ul>

                                                            <li><a href="<?php echo BASE_URL . 'index.php?page=shop_detail&id=' . $itemArtikal['id_artikal']; ?>" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                        </ul>

                                                        <input 
                                                            type="button" 
                                                            name="addToCart" 
                                                            id="add_to_cart"
                                                            class="btn hvr-hover add-to-cart-class"
                                                            data-id-artikla="<?php echo $itemArtikal['id_artikal']; ?>"
                                                            data-url="<?php echo BASE_URL ?>"
                                                            value="Add to Cart" 
                                                        >
                                                    </div>
                                                </div>
                                                <div class="why-text">
                                                    <h4><?php echo $itemArtikal['naziv'] ?></h4>
                                                    <h5> <?php echo "$" . $itemArtikal['cena'] ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>

                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="list-view">

                                    <?php foreach ($rezultat as $valueListView): ?>
                                    <div class="list-view-box">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                <div class="products-single fix">
                                                    <div class="box-img-hover">
                                                        <div class="type-lb">
                                                            <?php if(!empty($valueListView['promocije'])): ?>
                                                                <p class="sale"> <?php echo $valueListView['promocije']; ?></p>
                                                            <?php else: ?>
                                                                <?php echo '';?>
                                                            <?php endif;?>
                                                        </div>
                                                        <img src="images/artikli/<?php echo $valueListView['putanja'] ?>" class="img-fluid" alt="<?php echo $valueListView['alt'] ?>">
                                                        <div class="mask-icon">
                                                            <ul>
                                                                <li><a href="<?php echo BASE_URL . 'index.php?page=shop_detail&id=' . $itemArtikal['id_artikal']; ?>" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                            </ul>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                                                <div class="why-text full-width">
                                                    <h4><?php echo $valueListView['naziv'] ?></h4>
                                                    <h5><?php echo $valueListView['cena'] . ' din' ?></h5>
                                                    <p><?php echo $valueListView['opis'] ?></p>
                                                    <a class="btn hvr-hover" href="#">Add to Cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>

                                </div>
                            </div>
                            <center>
                                    <?php if($start != 0): ?>
                                    <a href='<?php echo $previousLink ?>' class="pagin"><-Previous</a>
                                    <?php endif;?>
                                    <?php 
                                        
                                        if ( ($start + $range) < $max):
                                     ?>
                                    <a href='<?php echo $nextLink ?>' class="pagin">Next-></a>
                                    <?php 
                                        endif;
                                     ?>
                            </center>
                        </div>
                    </div>
                </div>
                <?php 

                $queryKatArt = $conn-> prepare('SELECT kat.id_kategorija, kat.naziv AS naziv_kategorije, COUNT(*) AS kolicina_kategorije
                                                                        FROM kategorija kat INNER JOIN artikal art
                                                                            ON kat.id_kategorija = art.kategorija_id
                                                                        GROUP BY kat.naziv ');

                                try {
                                    $queryKatArt->execute();
                                    $rezultatCateg = $queryKatArt->fetchAll(PDO::FETCH_ASSOC);
                                } catch (PDOException $exception) {
                                    echo 'Greska: ', $exception->getMessage(), "\n";
                                }

                ?>
				<div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">
                    <div class="product-categori">
                        <div class="search-product">
                            <form action="<?php echo BASE_URL. 'index.php' ?>" method="GET">
                                <input name="page" class="form-control" type="hidden" value="shop">
                                <input name="search" class="form-control" placeholder="Search here..." type="text">
                                <button type="submit"> <i class="fa fa-search"></i> </button>
                            </form>
                        </div>
                        <div class="filter-sidebar-left">
                            <div class="title-left">
                                <h3>Categories</h3>
                            </div>
                            <div>

                                <?php
                                //Ispis kategorija
                                foreach ($rezultatCateg as $value):
                                ?>

                                <div class="shop-category">
                                    <a data-id-kategorije="<?php echo $value['id_kategorija']?>"  
                                        data-url-kategorije="<?php echo BASE_URL ?>"  
                                        href="#"> <?php echo $value['naziv_kategorije']?> <small class="text-muted">(<?php echo $value['kolicina_kategorije'] ?>)</small></a>
                                    
                                </div>

                                <?php endforeach; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Shop Page -->
