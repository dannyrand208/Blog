const express = require('express');
const path = require('path');
const fileupload =  require('express-fileupload')
let intial_path = path.join(__dirname,"upload");


const app = express();
app.use(express.static(intial_path));
app.use(fileupload());


app.get('/',(req,res) => {
    res.sendFile(path.join(intial_path,"home.html"));

})
app.post('/upload', (req,res) => {
    let file = req.file.image;
    let date = new Date();
    // image name
    let imagename = date.getDate() +date.getTime()+ file.name;
    // image upload path
    let path = 'blog1/upload' + imagename;

    // create uplopad
    file.mv(path, (eer,result)=> {
        if(err) {
            throw err;
        }else{
            // our image upload path
            res.json(`upload/${imagename}`)
        }
    })
})
app.listen("3000", () => {
    console.log('listening.....');
})