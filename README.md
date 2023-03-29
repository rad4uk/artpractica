sudo apt-get install jpegoptim
sudo apt-get install optipng
sudo apt-get install pngquant
sudo npm install -g svgo@1.3.2
sudo apt-get install gifsicle
sudo apt-get install webp

php artisan vendor:publish --provider="Spatie\LaravelImageOptimizer\ImageOptimizerServiceProvider"
