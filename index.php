<?php

include "conexao.php";
include "cabecalho.php";
?>

<body>
    <div class="cards-container">
        <h1>Simulado</h1>
        <form action="./resposta.php" method="post">
            <?php
        $query = "select * from questoes order by rand() limit 15";
        $resultado = mysqli_query($conexao, $query);

        while ($linha = mysqli_fetch_array($resultado)) {
        ?>
            <div class="card text-white bg-dark mb-3 mt-4">
                <div class="card-header">
                    <?php echo $linha["pergunta"]; ?>
                </div>
                <div class="card-body">
                    
                    <label>A)</label>
                    <input type="radio" name="<?php echo $linha["id"]; ?>" value="A" />
                    <span>
                        <?php echo $linha["a"]; ?>
                    </span>

                    <br><br>

                    <label>B)</label>
                    <input type="radio" name="<?php echo $linha["id"]; ?>" value="B" />
                    <span>
                        <?php echo $linha["b"]; ?>
                    </span>

                    <br><br>

                    <label>C)</label>
                    <input type="radio" name="<?php echo $linha["id"]; ?>" value="C" />
                    <span>
                        <?php echo $linha["c"]; ?>
                    </span>

                    <br><br>

                    <label>D)</label>
                    <input type="radio" name="<?php echo $linha["id"]; ?>" value="D" />
                    <span>
                        <?php echo $linha["d"]; ?>
                    </span>

                    <br><br>

                    <label>E)</label>
                    <input type="radio" name="<?php echo $linha["id"]; ?>" value="E" />
                    <span>
                        <?php echo $linha["e"]; ?>
                    </span>
                </div>
            </div>
            <?php
        }
        ?>
            <input class="btn btn-dark" type="submit" value="Enviar">
        </form>
    </div>


</body>

</html>