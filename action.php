<?php

$is_404 = false;
// ----------------------------------------------------------------------------------------------------------
// Проверка информации
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    getInfo();
}
else
{
    error404();
}
// ----------------------------------------------------------------------------------------------------------




// ----------------------------------------------------------------------------------------------------------
// Получаем информацию с формы
function getInfo()
{
    if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['secondname']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['about']))
    {
        if(!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['secondname']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['about']))
        {
            if(trim($_POST['name']) != ' ' && trim($_POST['surname']) != ' ' && trim($_POST['secondname']) != ' ' && trim($_POST['email']) != ' ' && trim($_POST['phone']) != ' ')
            {
                if($_FILES['file']['error'] == 0)
                {
                    if($_FILES['file']['type'] == 'image/jpg' || $_FILES['file']['type'] == 'image/png')
                    {
                        $name = $_POST['name'];
                        $surname = $_POST['suraname'];
                        $secondname = $_POST['secondname'];
                        $email = $_POST['email'];
                        $phone = $_POST['phone'];
                        $about = $_POST['about'];

                        $data = $name . $surname . '||' . $secondname . '||' . $email . '||' . $phone . '||' . $about . "\n";

                        move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . time() . $_FILES['file']['name']);

                        file_put_contents('plan.txt', $data, FILE_APPEND);
                    }
                }
            }
        }
    }
}
// ----------------------------------------------------------------------------------------------------------





// ----------------------------------------------------------------------------------------------------------
// Получаем информацию с базы данных
function getInfoDb($path_file)
{
    $string_info = file_get_contents($path_file);
   return $string_info;
}
$dataDb = getInfoDb('plan.txt');
// ----------------------------------------------------------------------------------------------------------





// ----------------------------------------------------------------------------------------------------------
// Функция вывода информации из базы данных на экран
function showInfo($dataDb)
{
    $array_info = explode('||', $dataDb);
    return $array_info;
}
$data_array = showInfo($dataDb);
// ----------------------------------------------------------------------------------------------------------




// ----------------------------------------------------------------------------------------------------------
// Получаем картинки
$dir_path = 'uploads/';
function getImg($dir_path)
{
    if(file_exists($dir_path))
    {
        $d = opendir($dir_path);
            while($file = readdir($d))
            {
                if($file == '.' || $file == '..')
                {
                    continue;
                }
                else
                {
                    $img = $dir_path . $file;
                }
            }
        closedir($d);
        return $img;
    }
}
$img_path = getImg($dir_path);
// ----------------------------------------------------------------------------------------------------------





// ----------------------------------------------------------------------------------------------------------
// Функция вывода ошибок

function error404()
{
    header("HTTP/1.0 404 Not Found");
    global $is_404;
    $is_404 = true;
}
// ----------------------------------------------------------------------------------------------------------


?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль:</title>
</head>
<body>
    <h1>Профиль:</h1>
    <?php if($is_404):?>
        <h1>Ошибка</h1>
    <?php else:?>

    <div class="accaunt">
        <?php if(!empty($img_path)):?>
            <img src="<?php echo $img_path;?>" alt="Изображение">
        <?php endif;?>
        <p>
            Имя: <span> <?php echo $data_array[0];?></span>
        </p>
        <p>
            Фамилия: <span> <?php echo $data_array[1];?></span>
        </p>
        <p>
            Отчество: <span> <?php echo $data_array[2];?></span>
        </p>
        <p>
            Email: <span> <?php echo $data_array[3];?></span>
        </p>
        <p>
            Телефон: <span> <?php echo $data_array[4];?></span>
        </p>
    </div>
    <?php endif;?>
</body>
</html>