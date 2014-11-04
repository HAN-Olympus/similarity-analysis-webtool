# README #

This tool aims to make the use of Cizar Almalak's similarity analysis tool easier, by providing a GUI.
The similarity analysis tool can be found here: https://bitbucket.org/CizarAlmalak/similarity_analysis

### How do I get set up? ###

- Setup a LAMP stack installed if you're using linux
and MAMP if you're using OS X.
If you're using Ubuntu you can setup a LAMP stack with the following command: sudo apt-get install lamp-server^

- Install mod_python. On Ubuntu you can install mod_python with the following command: sudo apt-get install libapache2-mod-python
- Enable mod_python by running a2enmod python
- Enable cgi by running a2enmod cgi
- Change PHP's upload_max_filesize to 3000M or more and post_max_size also to 3000M
(You can change it to the maximum filesize of files you're going to use with the tool.)



- Setup NCBI's BLAST+ suite and that it's setup in your $PATH variable.
- Make sure that you have all dependencies required by the similarity analysis tool installed.
- Make sure that you have a folder named OUTPUT and a folder named data_files in your web server's root folder.


