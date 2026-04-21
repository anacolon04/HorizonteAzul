<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
    }

    /* HEADER */
    <?php include '../assets/css_header.php' ?>

    /* Menú */
    <?php include '../assets/css_menu.php' ?>

    /* CONTENIDO */
    main {
        padding: 40px 20px;
    }

    section {
        margin-bottom: 30px;
    }

    .about {
        display: flex;
        gap: 30px;
        align-items: center;
        padding: 40px 20px;
    }

    .texto {
        width: 50%;
    }

    .imagen {
        width: 50%;
    }

    .imagen img {
        width: 400px;
        border-radius: 10px;
    }
    
    /* TABLA */
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: center;
    }
    img {
        width: 200px;
        height: auto;
    }

    /* FOOTER */
    <?php include '../assets/css_footer.php' ?>

    /*VIAJES DESTACADOS*/
    .grid.trips{
        display:grid;
        grid-template-columns:repeat(auto-fill,minmax(250px,1fr));
        gap:15px;
    }

    .trip{
        border:1px solid #ccc;
    }

    .thumb{
        height:150px;
        background-size:cover;
        background-position:center;
    }

    .content{
        padding:10px;
    }

    .tag{
        font-size:12px;
    }

    .meta span{
        display:block;
        font-size:14px;
    }

    .price{
        display:flex;
        justify-content:space-between;
        margin-top:10px;
    }

    .btn{
        padding:4px 8px;
        border:1px solid #000;
        text-decoration:none;
        font-size:13px;
    }

    .primary{
        background:#000;
        color:#fff;
    }

</style>