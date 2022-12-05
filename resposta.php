<?php
include "cabecalho.php";
?>
    <body>
        <div class="cards-container">
        <h1>Resultado</h1>
            <?php
            $pontuacao = 0;

            function obterDefinicaoReposta($questao, $alternativaRespondida, $alternativaFormulario)
            {
                if (alternativaCorretaSelecionada($questao, $alternativaRespondida, $alternativaFormulario)) 
                    return ['alert alert-success', '<span>CORRETA! - </span>'];
                
                
                if (alternativaIncorretaSelecionada($questao, $alternativaRespondida, $alternativaFormulario))
                    return ['alert alert-danger', '<span>SUA RESPOSTA - </span>'];
            
                return ['', ''];
            }

            function alternativaCorretaSelecionada($questao, $alternativaRespondida, $alternativaFormulario) {
                return alternativaCorreta($questao, $alternativaRespondida) 
                            && strtoupper($alternativaRespondida == $alternativaFormulario) 
                            || alternativaCorreta($questao, $alternativaFormulario);
            }

            function alternativaIncorretaSelecionada($questao, $alternativaRespondida, $alternativaFormulario) {
                return !alternativaCorreta($questao, $alternativaRespondida) && strtoupper($alternativaRespondida) == strtoupper($alternativaFormulario);
            }

            function definirPontuacao($questao, $alternativaRespondida) {
                global $pontuacao;
                if(alternativaCorreta($questao, $alternativaRespondida))
                    $pontuacao++;
            }

            function alternativaCorreta($questao, $alternativa)
            {
                return strtoupper($questao->correta) == strtoupper($alternativa);
            }
            function obterQuestaoPorQuestaoId($questaoId)
            {
                include "conexao.php";
                $query = "select * from questoes where id = $questaoId";
                return mysqli_query($conexao, $query)->fetch_object();
            }

            if (isset($_POST) && !empty($_POST)) {
                foreach ($_POST as $questaoId => $alternativa) {
                    $questao = obterQuestaoPorQuestaoId($questaoId);
                    definirPontuacao($questao, $alternativa);
                    ?>
                    <div class="card text-black mb-3 mt-4">
                        <div class="card-header">
                            <?php echo $questao->pergunta; ?>
                        </div>
                        <div class="card-body">
                            
                            <div class="<?php echo obterDefinicaoReposta($questao, $alternativa, 'A')[0];?>">
                                <?php echo obterDefinicaoReposta($questao, $alternativa, 'A')[1];?>
                                <label>A)</label>
                                <span>
                                    <?php echo $questao->a; ?>
                                </span>
                            </div>
                            <div class="<?php echo obterDefinicaoReposta($questao, $alternativa, 'B')[0];?>">
                                <?php echo obterDefinicaoReposta($questao, $alternativa, 'B')[1];?>
                                <label>B)</label>
                                <span>
                                    <?php echo $questao->b; ?>
                                </span>
                            </div>
                            <div class="<?php echo obterDefinicaoReposta($questao, $alternativa, 'C')[0];?>">
                                <?php echo obterDefinicaoReposta($questao, $alternativa, 'C')[1];?>
                                <label>C)</label>
                                <span>
                                    <?php echo $questao->c; ?>
                                </span>
                            </div>
                            <div class="<?php echo obterDefinicaoReposta($questao, $alternativa, 'D')[0];?>"> 
                                <?php echo obterDefinicaoReposta($questao, $alternativa, 'D')[1];?>
                                <label>D)</label>
                                <span>
                                    <?php echo $questao->d; ?>
                                </span>
                            </div>
                            <div class="<?php echo obterDefinicaoReposta($questao, $alternativa, 'E')[0];?>">
                                <?php echo obterDefinicaoReposta($questao, $alternativa, 'E')[1];?>
                                <label>E)</label>
                                <span>
                                    <?php echo $questao->e; ?>
                                </span>
                            </div>
                        </div>
                    </div>   
            <?php }
            } ?>
            <h3>Sua pontuação: <?php global $pontuacao; echo $pontuacao;?></h3>
        </div>
    </body>
</html>