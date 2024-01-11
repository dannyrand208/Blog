<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Blog : Editor</title>

    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="editor.css">

</head>
<body>

    <div class="banner">
        <form action="uploadImage.php" method="post" enctype="multipart/form-data">
        <?php
        
        echo "<img src='$img_url' alt=''>"
         ?>  
            <input type="file" accept="image/*" name="my_image" id="banner-upload" >
            <label for="banner-upload" class="banner-upload-btn">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAb1BMVEX///8UFBQAAAB0dHSxsbEODg42NjYtLS2urq5paWlxcXERERFsbGzv7+9GRkYHBwfAwMCmpqYjIyP5+fno6Oja2tpcXFzg4ODMzMx7e3uWlpbU1NSDg4Pm5uaKiooeHh5XV1dPT087OzugoKBhYWFvMAPCAAAEAklEQVR4nO3da3OiMBSHcXIqWstar9W21stevv9nXLAVk5TLCQkksf/n1c50hzm/sdAIKEmCEEIIIYQQQgghhBBCCCH0Q3ua/PI9Qr+dKaWp7yF6bP1MQog7Jq4nBfCOiRvxCcyJ/3zP0ksv87m4Rlvf0/TQK6XiFp19z+O8hQLMib99T+S4EWVCjZ59z+S0JYlv0fPa91juOlYAc+KfuyG+VQJz4njmezQ3/aoB5sTJXRC3tcCceIqf+LkUrW0uNr4ntGw2aQTmxPTge0arNqcbkG6LtrnEntPO95QW7SQVvZWHVOmfeSm9+J6zc/JSlJ6Sh1L4kDwpxL3vSTu2UIGKUCO++p61U/JStACqwjsgLmXg5U29KkymEjGjhd9pO/Quzf911kITRk6UD5b0df5QFyrLuYxG/qbtkPzyXPbBom9CZV/MaOlr2g6dq4AVQoUo6K+fac1TlqI3YJUwTuJsXLEPFlUJ1bdW9D78uObJS1H13G+lUNllBR2HHte8nXRWVDu5XS3UiB/DjmveXj5pKO2DRTVCbV9UfxZciwZgrVAjBn31TTkrqgPrhRox4Os2SwX47bWoF2pH1GCv27y3vBINQu1wE+h1m4+2X7UmoUY89z5th6ath4tGofaLGuB1m7MyoH6QudQs1A43wV23eW4HtgnDJh4ZwFahRgxrjdr8Z+KrVqH2lrivYbt0qFtsK7UL1XfOIZ3v30hntusXXQyh/CpSUBdtxHU5WrcPFnGEt30xFe7HtOh6FbsJyBOWxNBO20wpzbK0+a0PT5j/t8umglt/P46Jxs0nBJnCZFRs6tHlcI6atR0ZuELGpgKNL4w1COMPwviDMP4gjD8I4w/C+IMw/iCMPwjjD8L4gzD+IIw/COMPQr/N9vafv3Ip3O3dXp7abIloZXtR1p1wucrn2Tq8k+FAxWyp7f27zoQfl7tYidx9cvF6w5PlZ8xcCV+v4zi7beqlnMzu9l1XwvKOFGcfXByVN4CMrbbjSjgub21x9UGim3BitR1XwgmExkHIDUJuEJoHITcIuUFoHoTcIOQGoXkQcoOQG4TmQcgNQm4QmgchNwi5QWgehNwg5AaheRByg5AbhOZByA1CbhCaByE3CLlBaB6E3CDkFq6w/OpIy1txwxUuSqHdN8yHK0wmn1+iPLfdTLjCA1EqUuv7swMWJuvjiU5H2yd1hSx0E4TmQTh0EJoH4dBBaB6EQweheRAOHYTmQTh0EJoH4dBBaB6EQweheRAOXY/CbDV69N9olfUmFBmFUPnkpR6EgQUhhD9IuAhW6Op57DP5uXEBlbl7btkxzBfR5QOgp0RpaJHbp3ottuPQ2rraCRFCCCGEEEIIIYQQQgghhAbqP5FQO/RQDf06AAAAAElFTkSuQmCC" alt="upload banner">
            </label>
            <input type="submit" value="Upload" class="btn grey upload-btn">
        </form>
    </div>

    <div class="blog">
        <textarea type="text" class="title" placeholder="Blog title..."></textarea>
        <textarea type="text" class="article" placeholder="Start writing here..."></textarea>
    </div>

    <div class="blog-options">
        <button class="btn dark publish-btn">publish</button>
        <input type="submit" value="Upload" id="image-upload" hidden>
        <label for="image-upload" class="btn grey upload-btn">Upload Image</label>
    </div>

    <script src="js/editor.js"></script>
   
</body>
</html>
