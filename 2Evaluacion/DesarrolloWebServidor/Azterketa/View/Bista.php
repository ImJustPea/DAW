<?php


class Bista
{

    //Logina egin aurretik agertuko dena, formulario osoa.
    //Formulario completo con la parte del login.
    public function Login()
    {
?>

        <form method="POST" action="Controller/Controller.php">
            Erabiltzaile izena: <input type="text" name="username">
            <br>
            Pasahitza: <input type="password" name="password">
            <br>
            <input type="submit" name="Hasi" value="Sesioa Hasi">
            <input type="submit" name="Alta" value="Alta">
            <input type="submit" name="Aldatu" value="Pasahitza Aldatu">
        </form>

    <?php
    }
    //Vista del ususario que no es admin.
    public function erabiltzaileGunea($produktuak)
    {
    ?>

        <h1>Produktuak Erosi</h1>
        <form method="POST" action="../Controller/Controller.php">
            <?php
            echo '<select name="produktuak">';
            foreach ($produktuak as $produktua) {
                $id = $produktua['id'];
                $izena = $produktua['izena'];
                $prezioa = $produktua['prezioa'];
                echo '<option value="' . $id . '">' . $izena . ' ' . $prezioa . '€</option>';
            }
            echo "</select>";

            echo '<select name="zenbakiak">';
            for ($i = 1; $i <= 10; $i++) {
                echo "<option value='$i'>$i</option>";
            }
            echo '</select>';

            echo '<input type="submit" value="Erosi" name="Erosi"/> ';
            echo "</form>";
        }


        public function aldatuPasahitza()
        {
            ?>
            <form method="POST" action="../Controller/Controller.php">
                <div>
                    <div>
                        <label><b>Sartu pasahitz berria:</b></label>
                        <input type="text" name="pasahitza" />
                    </div>

                    <input type="submit" value="Aldatu" name="Aldatu_Pasahitza" />
                </div>
            </form>
        <?php
        }



        //Behin logina agiaztatuta dagoenean agertuko dena, login gabeko formularioa.
        //Una vez que el login esté verificado, el fomulario sin la parte de login.
        public function altaEman()
        {
        ?>
            <form method="POST" action="../Controller/Controller.php">
                <div>
                    <div>
                        <label><b> Id:</b></label>
                        <input type="text" name="id" />
                    </div>
                    <div>
                        <label><b> Izena:</b></label>
                        <input type="text" name="izena" />
                    </div>

                    <div>
                        <label><b>Pasahitza:</b></label>
                        <input type="password" name="pasahitza" />
                    </div>
                    <br>
                    <div>
                        <label><b>Administratzailea:</b></label>
                        Bai<input type="radio" name="admin" value='1' />
                        Ez<input type="radio" name="admin" value='0' />
                    </div>
                    <br>

                    <input type="submit" value="Bidali" name="Alta_Eman" />
                </div>
            </form>
        <?php
        }
        public function adminErabiltzaileGunea()
        {
        ?>
            <h1>Denda Kudeaketa</h1>
            <form method="POST" action="../Controller/Controller.php">
                <input type="submit" value="Produktua Sortu" name="Produktuak" />
                <input type="submit" value="Eskariak Erakutsi" name="Eskariak" />
            </form>

        <?php
        }
        //Dado un array de arrays asociativo se representan los pedidos en una tabla.
        public function eskarienTaulaSortu($eskariak)
        {
            echo "<h1>Eskarien Xehetasunak</h1>";
            echo ' <form method="POST" action="../Controller/Controller.php">';
            echo "<table>";
            echo "       <thead>";
            echo "           <tr>";
            echo "               <th>Bezeroa</th>";
            echo "               <th>Produktua</th>";
            echo "               <th>Kantitatea</th>";
            echo "           </tr>";
            echo "       </thead>";
            echo "       <tbody>";
            foreach ($eskariak as $eskaria) {
                echo "<tr>";
                foreach ($eskaria as $zutabea) {
                    echo "<td>$zutabea</td>";
                }
                echo "</tr>";
            }
            echo "       </tbody>";
            echo "   </table>";
        ?>
        </form>
    <?php


        }
        public function produktuaSortu()
        {
    ?>

        <h1>Produktua Sortu</h1>
        <form method="POST" action="../Controller/Controller.php">
            <div>
                <label><b> Id</b></label>
                <input type="text" name="id_produktua" />
            </div>
            <div>
                <label><b> Izena</b></label>
                <input type="text" name="izena" />
            </div>

            <div>
                <label><b> Prezioa</b></label>
                <input type="text" name="prezioa" />
            </div>
            <input type="submit" value="Sortu" name="Sortu_Produktuak" />

    <?php
        }
    }
