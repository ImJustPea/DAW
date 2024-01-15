var app = angular.module('animalApp', []);

app.controller('AnimalController', function ($scope, $http) {
    $scope.animals = [];
    $scope.animalsChuleta = [];
    $scope.results = {};
    $scope.gameStarted = false;

    // Cargar el arreglo de animales desde el archivo JSON
    $http.get('json/animales.json')
        .then(function (response) {
            $scope.animals = response.data;

            $scope.animalsChuleta = $scope.animals.map(function (animal) {
                var correctDato = "R" + ++animal.correcto;
                return {
                    imgAnimal: animal.imgAnimal,
                    nombre: animal[correctDato]
                };
            });

        })
        .catch(function (error) {
            console.error('Error al cargar el archivo JSON:', error);
        });

    $scope.start = function () {
        $('#zonatest').show();
    };

    $scope.startGame = function (level) {
        // Lógica para iniciar el juego
        $scope.gameStarted = true;
        switch (level) {
            case "facil":
                $scope.filteredAnimals = $scope.animals.filter(function (animal) {
                    return animal.tipo === "0";
                });
                break;

            case "medio":
                $scope.filteredAnimals = $scope.animals.filter(function (animal) {
                    return animal.tipo === "1";
                });
                break;

            case "dificil":
                $scope.filteredAnimals = $scope.animals.filter(function (animal) {
                    return animal.tipo === "2";
                });
                break;
        }
    };

    $scope.checkAnswer = function (event, id, selectedAnswer, correctIndex) {
        var elementoDeDatos = $scope.animals.find(function (elemento) {
            return elemento.id === id;
        });

        if (elementoDeDatos.answered == "false") {
            var correctIndex = "R" + elementoDeDatos.correcto++;
            var correctAnimalName = elementoDeDatos[correctIndex];

            if (selectedAnswer === correctAnimalName) {
                $scope.results[selectedAnswer] = 'Correcto';
            } else {
                $scope.results[selectedAnswer] = 'Incorrecto';
            }

            console.log($scope.results);

            elementoDeDatos.answered = true;
            event.target.classList.add('seleccionado');

            if (Object.keys($scope.results).length == $scope.filteredAnimals.length) {
                $('#zonaresultados').show();
            }

        } else {
            alert("Este animal ya ha sido respondido.");
        }
    };

    $scope.checkResults = function () {
        if ($('#chuleta').is(':visible')) {
            $('#chuleta').hide();
        } else {
            $('#chuleta').show();
        }
    }

    $scope.resetGame = function () {
        $scope.animals.forEach(function (animal) {
            animal.answered = "false";
        });
        $scope.results = {};
        $scope.gameStarted = false;
        $('.seleccionado').removeClass('seleccionado');
        $('#zonaresultados').hide();
    }
});
