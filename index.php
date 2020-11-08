<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Trabalho Bimestral Desenvolvimento de Aplicações - ADS Unicesumar">
        <title>Jogo da Velha</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/42ec842f71.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="estilos.css">
    </head>

    <body>
        <div class="container jogoDaVelha">
            <div class="titulo">
                <h1>Jogo da Velha</h1>
            </div>

            <div class="row jogo">
                <div class="card col-6">
                    <p class="vez" id="vez"></p>
                    <table border="2"  class="tabela" id="tabela">
                        <tr class="espaçamento">
                            <td class="quadrante" id="Q1" onclick="xAqui('Q1')"></td>
                            <td class="quadrante" id="Q2" onclick="xAqui('Q2')"></td>
                            <td class="quadrante" id="Q3" onclick="xAqui('Q3')"></td>
                        </tr>
            
                        <tr class="espaçamento">
                            <td class="quadrante" id="Q4" onclick="xAqui('Q4')"></td>
                            <td class="quadrante" id="Q5" onclick="xAqui('Q5')"></td>
                            <td class="quadrante" id="Q6" onclick="xAqui('Q6')"></td>
                        </tr>
            
                        <tr class="espaçamento">
                            <td class="quadrante" id="Q7" onclick="xAqui('Q7')"></td>
                            <td class="quadrante" id="Q8" onclick="xAqui('Q8')"></td>
                            <td class="quadrante" id="Q9" onclick="xAqui('Q9')"></td>
                        </tr>
                    </table>
                </div>

                <div class="card col-6">
                <div class="placar">
                        <div class="row">
                            <div class="col-4">
                                <p>Jogador X</p>
                                <p id="placarJogador">0</p>
                            </div>

                            <div class="col-4">
                                <p>Empates</p>
                                <p id="placarVelha">0</p>
                            </div>

                            <div class="col-4">
                                <p>Computador O </p>
                                <p id="placarComputador">0</p>
                            </div>

                        </div>
                    </div>
                    
                    <div class="comandos">
                        <button class="iniciar" id="inciar" onclick="carregaTabela()">Iniciar</button>
                        <button class="zerar" id="zeraPlacar" onclick="zeraPlacar()">Zerar Placar</button>
                    </div>

                    <p id="resultado" class="resultado">_</p>

                    <div class="dificuldade">
                        <p>Dificuldade:</p>

                        <button id="facil" onclick="setDificuldade(1,'facil')">Fácil</button>
                        <button id="medio" onclick="setDificuldade(2, 'medio')">Médio</button>
                        <button id="dificil" onclick="setDificuldade(3, 'dificil')">Difícil</button>
                        
                    </div>
                </div>
            </div>
        </div>
    </body>

    <script type="text/javascript">

        var contador = 0;
        var vitJogador = 0;
        var vitCPU = 0;
        var empate = 0;
        var dificuldade = 1;
        var jogada;
        var prioridade = 0;
        setVez = 0;
        onload = turno(setVez);
        onload = setDificuldade(1,"facil");

        function zeraPlacar(){
            vitCPU      = 0;
            vitJogador  = 0;
            empate      = 0;
            atualizaPlacar();
        }

        function setDificuldade(n, id){
            dificuldade = n;            
            setCor("facil", "black", "#e6e6e6");
            setCor('medio', "black", "#e6e6e6");
            setCor('dificil', "black", "#e6e6e6");
            
            if (dificuldade == 1)
                setCor(id,"white","#5196d8");
            if (dificuldade == 2)
                setCor(id,"white","#d67333");
            if (dificuldade == 3)
                setCor(id,"white","#880909");
        }

        function setCor(id, corLetra, corFundo){
            elemento = document.getElementById(id);
            elemento.style.color = corLetra;
            elemento.style.backgroundColor = corFundo;
        }

        function carregaTabela(){
            document.getElementById("resultado").innerHTML = "_";
            elemento = document.getElementById("tabela");
            elemento.style.visibility = "visible";
            limpaTabela();
            turno(1);
            vitoria = false;
            contador = 0;
            console.clear;
            console.log("novo jogo");
        }

        function limpaTabela(){
            for (var x = 1; x < 10 ; x++){
                var id = "Q" + x;
                elemento = document.getElementById(id);
                elemento.innerHTML = "";
                elemento.style.backgroundColor = "ivory";
            }
        }

        function sleep (time) {
            return new Promise((resolve) => setTimeout(resolve, time));
        }

        function xAqui(id){
            if (setVez == 1){
                elemento = document.getElementById(id);
                if (elemento.innerHTML == ""){
                    elemento.innerHTML = "X";
                    contador++;
                    console.log("x marcado");

                    if (contador < 5){
                        turno(2);
                    } else turno(0);

                    sequencias(0);

                    if (vitoria == false){
                        sleep(2000).then(() => {
                            jogaO()
                        });
                    }

                    if (vitoria == false && contador == 5){
                        empate++;
                        document.getElementById("resultado").innerHTML = "Deu Velha";
                        atualizaPlacar();
                    }

                } else return 0;
            } else return 0;
        }

        function jogaO(){
            if (setVez = 2){
                if (contador < 5){
                    if (dificuldade == 1){
                        jogadaSimples();
                    }
                    if (dificuldade == 2){
                        do {var n = math.floor(Math.random() * 10 + 1)} while (x>2);
                            if (n == 1)
                                jogadaSimples();
                                else jogadaPensada();
                    }
                    if (dificuldade == 3){
                        jogadaPensada();
                    }
                    turno(1);
                    sequencias(0);
                }
            }
        }

        function jogadaSimples(){
            var saida = false;
            do{
                do { var x = Math.floor(Math.random() * 10 + 1);} while (x >9);
                var id = "Q" + x;
                elemento = document.getElementById(id);
                if (elemento.innerHTML == ""){
                    elemento.innerHTML = "O";
                    saida = true;
                    console.log("jogadaSimples");
                }
            } while (saida == false);
        }

        function jogadaPensada(){
            sequencias(1);
            if (jogada == 1){
                jogadaSimples();
            }
            console.log("Fim jogada Pensada");
        }

        function turno(vez){
            var elemento = document.getElementById("vez");
            if (vez == 0){ 
                setVez = 0;
                elemento.innerText = "Pressione INICAR para jogar";
            }
            if (vez == 1){ 
                setVez = 1;
                elemento.innerText = "VEZ DO JOGADOR";
            }
            if (vez == 2){ 
                setVez = 2;
                elemento.innerText = "VEZ DO COMPUTADOR";
            }
        }

        function sequencias(n){
            testaSequencia(1,2,3,n);
            testaSequencia(4,5,6,n);
            testaSequencia(7,8,9,n);
            testaSequencia(1,5,9,n);
            testaSequencia(3,5,7,n);
            testaSequencia(1,4,7,n);
            testaSequencia(2,5,8,n);
            testaSequencia(3,6,9,n);
        }

        function testaSequencia(x,y,z,n){
            var id1 = "Q" + x;
            var id2 = "Q" + y;
            var id3 = "Q" + z;

            pos1 = document.getElementById(id1);
            pos2 = document.getElementById(id2);
            pos3 = document.getElementById(id3);
            
            if (n==0){
                if (pos1.innerHTML != "" && pos1.innerHTML == pos2.innerHTML && pos2.innerHTML == pos3.innerHTML){
                    pintaTabela(id1, "#5def9b");
                    pintaTabela(id2, "#5def9b");
                    pintaTabela(id3, "#5def9b");
                    vitoria = true;

                    if (pos1.innerHTML == "X"){
                        vitJogador++;
                        document.getElementById("resultado").innerHTML = "Vitoria do Jogador";
                    }   else {
                            vitCPU++;
                            document.getElementById("resultado").innerHTML = "Vitoria do Computador";
                        }
                    atualizaPlacar();
                    turno(0);
                }   
            }

            if (n==1){
                jogada = 0;
                if (setVez == 2){
                    if (pos1.innerHTML != "" && pos1.innerHTML == pos2.innerHTML){
                        if (pos3.innerHTML == ""){
                            pos3.innerHTML = "O";
                            turno(1);
                            console.log("Achei iguais e marquei");
                            return 0;
                        }
                    }
                    if (pos1.innerHTML != "" && pos1.innerHTML == pos3.innerHTML){
                        if (pos2.innerHTML == ""){
                            pos2.innerHTML = "O";
                            turno(1);
                            console.log("Achei iguais e marquei");
                            return 0;
                        }
                    }
                    if (pos2.innerHTML != "" && pos2.innerHTML == pos3.innerHTML){
                        if (pos1.innerHTML == ""){
                            pos1.innerHTML = "O";
                            turno(1);
                            console.log("Achei iguais e marquei");
                            return 0;
                        }
                    }
                jogada++;
                }
            }
        }

        function pintaTabela(id,cor){
            document.getElementById(id).style.backgroundColor = cor;
        }

        function atualizaPlacar(){
            document.getElementById("placarJogador").innerHTML = vitJogador;
            document.getElementById("placarComputador").innerHTML = vitCPU;
            document.getElementById("placarVelha").innerHTML = empate;
        }

    </script>
</html>