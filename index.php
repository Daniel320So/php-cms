<?php

include( 'admin/includes/database.php' );
include( 'admin/includes/config.php' );
include( 'admin/includes/functions.php' );

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Daniel So - Web Developer</title>
    <link rel="stylesheet" type="text/css" href="./styles/style.css">
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon/favicon-16x16.png">
    <link rel="manifest" href="./images/favicon/site.webmanifest">
    <link rel="mask-icon" href="./images/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="./scripts/script.js"></script>
  </head>
  <body>
    <!-- Header -->
    <header id="header">  
        <!-- Site Logo -->  
        <a href="#" class="header-item" id="header-logo-container">
            <img src="./images/danielsodev-logo.png" alt="The Logo of DanielSo.Dev">
        </a>
        <!-- Main Navigation-->
        <div id="menu-button">
            <img src="./images/menu_button.png" alt="The image of menu button">
        </div>
        <nav class="header-item" id="main-navigation">
            <ul id="menu"></ul>
        </nav>
    </header>
    <main>
        <!-- Main -->
        <section id="main">
            <div id="tag-line">
                <h2 class="tag-line-item" id="tag-line-1">I <span>D</span>esign, </h2>
                <h2 class="tag-line-item" id="tag-line-2"><span>D</span>evelop, </h2>
                <h2 class="tag-line-item" id="tag-line-3"><span>D</span>eploy.</h2> 
            </div>
            <h1> I'm <span>D</span>aniel</h1>
            <p> A Full Stack Developer that Turns Ideas into Reality</p>
        </section>
        
        <!-- About Me -->
        <section id="about">
            <img id="background-pattern-1" src="./images/patterns/Background_Pattern_1.png" alt="Background_Pattern_of diamonds">
            <h2> About Me </h2>
            <div id="about-container"> 
                <!-- Description -->
                <div id="description">
                    <div class="description-item" id="name">
                        <p>Name</p>
                        <div class="description-detail">
                            <p>Ho Kit So, Daniel</p>
                        </div>
                    </div>
                    <div class="description-item" id="education">
                        <p>Education</p>
                        <div class="description-detail">
                        <?php
                            $query = 'SELECT *
                            FROM educations WHERE user_id = 2 ORDER BY id';
                            $result = mysqli_query( $connect, $query );
                        ?>
                        <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
                            <h4><?php echo $record['school_name']; ?></h4>
                            <small><?php echo $record['level_of_education']; ?> in <?php echo $record['field']; ?></small>
                            <br>
                        <?php endwhile; ?>
                        </div>
                    </div>
                </div>

                <!-- Technical Knowledge-->
                <div id="technical-knowledge">
                    <img src="./images/about/technical-knowledge.png">
                </div>
            </div>
        </section>

        <!-- Working Experience -->
        <section id="experience">
            <img id="background-pattern-2" src="./images/patterns/Background_Pattern_2.png" alt="Background_Pattern_of lines">
            <h2 id="mobile-header"> Working Experience </h2>
            <?php
                $query = 'SELECT *
                FROM experience WHERE user_id = 2 ORDER BY id';
                $result = mysqli_query( $connect, $query );
                $record = mysqli_fetch_all($result, MYSQLI_ASSOC);
            ?>

            <div id="experience-image">
                <?php
                    for ($i = 0; $i < count($record); $i++) {
                        $counter = $i + 1;
                        if ( $counter == 1) {
                            echo '<img class="experience-image-frame experience-active" id="experience-image-frame-'.$counter.'" src="'.$record[$i]['photo'].'"></img>';
                        } else {
                            echo '<img class="experience-image-frame" id="experience-image-frame-'.$counter.'" src="'.$record[$i]['photo'].'"></img>';
                        }

                    };
                ?>
            </div>
            <?php
                for ($i = 0; $i < count($record); $i++) {
                    $counter = $i + 1;
                    if ( $counter == 1) {
                        echo '
                        <div class="experience-description" id="experience-description-'.$counter.'";>
                            <h2>Working Experience</h2>
                            <h3>'.$record[$i]['title'].'</h3>
                            <p>@ '.$record[$i]['company'].'</p>
                            <div id="experience-details">'.$record[$i]['content'].'</div>               
                            <button id="btn-resume">View Resume</button>
                        </div>';
                    } else {
                        echo '
                        <div class="experience-description" id="experience-description-'.$counter.'" style="display: none";>
                            <h2>Working Experience</h2>
                            <h3>'.$record[$i]['title'].'</h3>
                            <p>@ '.$record[$i]['company'].'</p>
                            <div id="experience-details">'.$record[$i]['content'].'</div>               
                            <button id="btn-resume">View Resume</button>
                        </div>';
                    }
                };
            ?>
        </section>

        <!-- Projects -->
        <section id="projects">
            <h2>Projects</h2>
            <div id="projects-container">
                <?php
                    $query = 'SELECT *
                    FROM projects WHERE user_id = 2 ORDER BY id';
                    $result = mysqli_query( $connect, $query );
                    $record = mysqli_fetch_all($result, MYSQLI_ASSOC);

                    for ($i = 0; $i < count($record); $i++) {
                        $counter = $i + 1;
                        echo '
                            <div class="projects-item" id="project-'.$counter.'">
                                <div class="project-image-container">
                                    <img src="'.$record[$i]['photo'].'" alt="Image of'.$record[$i]["title"].'">
                                    <div class="link-container">
                                        <a href="'.$item[$i]["url"].'" target="_balnk" class="project-link"><p>Site</p></a>
                                    </div>
                                </div>
                                <div class="projects-text">
                                    <h3>'.$record[$i]["title"].'</h3>
                                </div>
                            </div>';
                    };
                ?>
            </div>
        </section>

        <!-- Contacts -->
        <section id="contacts">
            <!-- First Panel-->
            <div class="contacts-item" id="contacts-1">
                <h2>Contact Me</h2>
                <div id="contacts-img-container">
                    <a href="mailto:dan320so@gmail.com"><img src="./images/contacts/gmail.svg" alt="The Logo of Mail"></a>
                    <a href="https://www.linkedin.com/in/daniel-so-8054b5154/" target="_blank"><img src="./images/contacts/linkedin.svg" alt="The Logo of Linkedin"></a>
                    <a href="https://github.com/Daniel320So" target="_blank"><img src="./images/contacts/github.svg" alt="The Logo of Github"></a>
                    <a href="https://wa.me/85263357003" target="_blank"><img src="./images/contacts/whatsapp.png" alt="The Logo of Whatsapp"></a>
                </div>
            </div>
            <!-- Second Panel-->
            <div class="contacts-item" id="contacts-2">
                <form id="contacts-form">
                    <label id="nameLabel" for="nameInput">Name</label>
                    <input type="text" class="form-input" id="nameInput" name="nameInput" autocomplete="off">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-input" id="subject" name="subject" autocomplete="off">
                    <label for="message">Message</label>
                    <textarea id="message" class="form-input" name="message" rows="10" cols="50"></textarea autocomplete="off">
                    <p id="form-msg"></p>
                    <input id="form-submit" type="submit" value="Send">
                </form>
            </div>
            
        </section>
    </main>
    <!-- Footer -->
    <footer>
        <div class="footer-item" id="footer-disclaimer-container">
            <p id="footer-disclaimer" >© All Right Reserved By Ho Kit So, Daniel 2023.</p>
        </div>
        <!-- Site Logo -->  
        <a href="#" class="footer-item" id="footer-logo-container">
            <img src="./images/danielsodev-logo.png" alt="The Logo of DanielSo.Dev">
        </a>
    </footer>
  </body>
</html>