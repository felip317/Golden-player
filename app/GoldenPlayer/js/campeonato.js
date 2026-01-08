var data = {
  teams: [
    ["PSV", "ARSENAL"],
    ["REAL MADRID", "ATLETICO DE MADRID"],
    ["PSG", "LIVERPOOL"],
    ["BRUJAS", "ASTON VILLA"],
    ["BENFICA", "BARCELONA"],
    ["DORTMUND", "LILLE"],
    ["BAYERN MUNCHEN", "BAYERN LEVERKUSEN"],
    ["FEYENORD", "INTER"]
  ],
  results: [
    // Cuartos (4 partidos)
    [[3,9], [4,2], [4,1], [1,6], [1,4], [3,2], [5,0], [1,4]],
    // Cuartos (4 partidos)
    [[5,1], [5,4], [5,3], [3,4]],

    // Semifinales (2 partidos)
    [[1,3], [6,7]],

    // Final (1 partido)
    [[5,0]]
  ]
};

$('#tournament').bracket({
  init: data
});


