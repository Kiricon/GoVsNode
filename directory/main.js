var walkSync = function(dir, filelist) {
    console.log(filelist);
  var path = path || require('path');
  var fs = fs || require('fs'),
      files = fs.readdirSync(dir);
  files.forEach(function(file) {
    if (fs.statSync(path.join(dir, file)).isDirectory()) {
        try {
            walkSync(path.join(dir, file), filelist);
        }catch(exception){
            console.log('Can\'t read directory!');
        }
    }
    else {
     // filelist.push(file);
     console.log(file);
    }
  });
};
console.time("execution");
walkSync(process.argv[2]);
console.timeEnd("execution");

//console.log(process.argv[2]);