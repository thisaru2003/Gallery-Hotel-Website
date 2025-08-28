<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>The Gallery Café</title>
        <link rel ="icon" type="image" href="../Images/Icon.png"> 
        <link rel="stylesheet" href="../CSS/ContentArt.css">
    
    </head>
<body>
    <header>
    <?php
session_start();
if (isset($_SESSION['user_role'])) {
    switch ($_SESSION['user_role']) {
        case 'admin':
            include 'adminheader.php';
            break;
        case 'staff':
            include 'staffheader.php';
            break;
        case 'users':
            include 'header.php'; 
            break;
        default:
            include 'header.php'; 
            break;
    }
} else {
    include 'header.php';
}
?>    </header>
    <div class="Mcontent">
    <div class="topic">  
    <h3><b>#Art Gallery</b></h3>
    <p>Art in restaurants can significantly enhance the dining experience by creating a unique and engaging atmosphere. It can serve as a visual feast, complementing the culinary offerings and adding to the overall ambiance. Art can range from paintings and sculptures to murals and installations, each reflecting the restaurant's theme or style. It can also be a conversation starter, offering guests something to admire and discuss while dining. Whether it's modern, classic, local, or international, art in restaurants contributes to a memorable and immersive experience for patrons.
    </p>
    </div>
    <div class="wcontent">
        <p><b>- Image Gallery -</b></p>
    </div>
    <div class="wrapper">
        <div class="container">
            <input type="radio" name="slide" id="c1" checked>
            <label for="c1" class="card">
                <div class="row">
                    <div class="icon">1</div>
                </div>
            </label>
            <input type="radio" name="slide" id="c2" >
            <label for="c2" class="card">
                <div class="row">
                    <div class="icon">2</div>
                </div>
            </label>
            <input type="radio" name="slide" id="c3" >
            <label for="c3" class="card">
                <div class="row">
                    <div class="icon">3</div>
                </div>
            </label>
            <input type="radio" name="slide" id="c4" >
            <label for="c4" class="card">
                <div class="row">
                    <div class="icon">4</div>
                </div>
            </label>
            <input type="radio" name="slide" id="c5" >
            <label for="c5" class="card">
                <div class="row">
                    <div class="icon">5</div>
                </div>
            </label>
        </div>
    </div>
    <div class="des1">
        <p>Art in restaurants goes beyond mere decoration; it plays a vital role in shaping the establishment's identity and ambiance. The choice of artwork can convey the restaurant's theme, whether it's a cozy, rustic eatery, a sleek, modern bistro, or an elegant fine dining venue. By incorporating local artists or cultural elements, restaurants can also connect with the community and provide a sense of place.<br><br>Art can influence the mood of the space, setting a tone that aligns with the dining experience. For instance, vibrant, bold pieces might energize a casual dining area, while serene landscapes or abstract works can create a calming atmosphere in a fine dining setting. The arrangement and lighting of the art can also impact how guests perceive the space, making it feel more open, intimate, or lively.
        </p>
        </div>
        <br>
        <div class="des2">
        <p>Moreover, art in restaurants can be a form of storytelling, reflecting the culinary journey or the chef's inspiration. It can highlight the restaurant's philosophy, such as sustainability or cultural fusion, and create a cohesive narrative that enhances the overall experience. Art can also engage guests on an emotional level, making their visit more memorable and encouraging them to return.<br><br>In some cases, restaurants even host art exhibitions or collaborate with artists, creating a dynamic space that evolves over time. This not only supports the local art scene but also keeps the restaurant's environment fresh and exciting for repeat customers. Ultimately, art in restaurants enriches the dining experience, offering a feast for the eyes as well as the palate.
        </p>
        </div>
    </div>

    <div onclick="scrollToTop()" class="scrollTop">Top</div>
    <footer>
    <?php include('footer.php') ?>
    </footer> 
    <script>
        function scrollToTop(){
            window.scrollTo(0, 0);
        }
    </script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>        
</body>
</html>