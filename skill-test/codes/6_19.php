<?php
echo number_format ( disk_free_space ( 'c:\\' ) / disk_total_space ( 'c:\\' ) * 100, 2 ) . '%';
?> 