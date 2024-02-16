
mkdir /home/ftp
mkdir /home/secret
chmod 755 /home/ftp
echo "anonymous_enable=YES" >> /etc/vsftpd.conf
echo "anon_root=/home/ftp" >> /etc/vsftpd.conf
echo "allow_writeable_chroot=YES" >> /etc/vsftpd.conf
echo "pasv_enable=NO" >> /etc/vsftpd.conf
echo "anon_upload_enable=YES" >> /etc/vsftpd.conf
echo "anon_mkdir_write_enable=YES" >> /etc/vsftpd.conf
echo "local_root=/home/ftp" >> /etc/vsftpd.conf
echo "El sistema ha descubierto una brecha de seguridad con un usuario, revisa el .txt que he añadido dentro de http://172.17.0.2/archives/ y notificale el mensaje!" > /home/ftp/IMPORTANTE.txt
echo "He modificado los permisos del fichero /etc/shadow para no olvidar mi password" > /home/secret/.nota.txt
chmod 777 /etc/shadow
