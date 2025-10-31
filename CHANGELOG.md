# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]
### Changed
- removing Xdebug version in Dockerfile.

## [6.10.0] - 2025-09-30
### Changed
- PHPUnit 12.3.7 => 12.3.15.
- phpcs 3.13.2 => 3.13.4.
- phpcbf 3.13.2 => 3.13.4.
- symfony/string v7.3.3 => v7.3.4.
- cyril-verloop/codingame-configuration 1.18.0 => 1.19.0.

## [6.9.0] - 2025-08-31
### Changed
- PHPUnit 12.3.0 => 12.3.7.
- psalm 6.13.0 => 6.13.1.
- cyril-verloop/codingame-configuration 1.17.1 => 1.18.0.
- symfony/string v7.3.2 => v7.3.3.
- symfony/polyfill-* v1.32.0 => v1.33.0.

## [6.8.1] - 2025-07-31
### Changed
- cyril-verloop/codingame-configuration 1.17.0 => 1.17.1.

## [6.8.0] - 2025-07-31
### Changed
- cyril-verloop/codingame-configuration 1.16.0 => 1.17.0.
- symfony/string v7.3.0 => v7.3.2.
- PHPUnit 12.2.5 => 12.2.9.
- psalm 6.12.0 => 6.13.0.

## [6.7.0] - 2025-06-30
### Changed
- PHPUnit 12.1.6 => 12.2.5.
- cyril-verloop/codingame-configuration 1.15.0 => 1.16.0.

## [6.6.0] - 2025-05-31
### Changed
- cyril-verloop/codingame-configuration 1.14.0 => 1.15.0.

## [6.5.0] - 2025-04-30
### Changed
- cyril-verloop/codingame-configuration 1.13.1 => 1.14.0.

### Fixed
- code and test files generation when the configuration has no PHP code.
- copy Psalm on installation instead of linking.

## [6.4.1] - 2025-03-31
### Changed
- cyril-verloop/codingame-configuration 1.13.0 => 1.13.1.

### Fixed
- generation of tests files when the name of a test contains "*/".

## [6.4.0] - 2025-03-31
### Changed
- cyril-verloop/codingame-configuration 1.12.0 => 1.13.0.

## [6.3.0] - 2025-02-28
### Changed
- cyril-verloop/codingame-configuration 1.11.2 => 1.12.0.

## [6.2.0] - 2025-01-31
### Changed
- cyril-verloop/codingame-configuration 1.10.0 => 1.11.2.

## [6.1.0] - 2024-12-31
### Changed
- cyril-verloop/codingame-configuration 1.9.0 => 1.10.0.

## [6.0.0] - 2024-11-30
### Changed
- PHP 8.3 => 8.4.

## [5.5.0] - 2024-11-30
### Changed
- cyril-verloop/codingame-configuration 1.8.0 => 1.9.0.

## [5.4.0] - 2024-10-31
### Changed
- Renaming `docker-compose.yml` to `compose.yaml` and `docker-compose.override.yml` to `compose.override.yaml`.
- cyril-verloop/codingame-configuration 1.7.0 => 1.8.0.

## [5.3.0] - 2024-09-30
### Changed
- cyril-verloop/codingame-configuration 1.6.0 => 1.7.0.

## [5.2.1] - 2024-09-02
### Changed
- cyril-verloop/codingame-configuration 1.5.0 => 1.6.0.

### Fixed
- test execution by updating "codingame-configuration".

## [5.2.0] - 2024-08-31
### Changed
- cyril-verloop/codingame-configuration 1.4.1 => 1.5.0.

## [5.1.0] - 2024-07-31
### Changed
- cyril-verloop/codingame-configuration 1.2.1 => 1.4.1.

## [5.0.0] - 2024-05-23
### Changed
- Configurations, inputs, outputs and default codes are now in a separate project.
- Default codes and tests are now generated in the `Easy`, `Medium`, `Hard` and `Expert` sub-directories
of the `src` and `tests` directories.

## [4.2.0] - 2024-05-13
### Added
- Community training medium configurations.

## [4.1.0] - 2024-04-22
### Added
- Community training easy configurations.

## [4.0.0] - 2024-03-21
### Added
- Aliases in `.ashrc.dist`.
- Infection.

### Changed
- PHP 7.3 => 8.3.
- PHPUnit 9 => 11.
- Generating code and test from configuration files.
- Customised user in the container instead of root.

### Removed
- Community code and test.

## [3.17.0] - 2023-01-31
### Added
- Tests for "Remainder fantasy".
- Tests for "Bust speeding vehicles".
- Tests for "Is the king in check? (part 2)".
- Tests for "Kaprekar's routine".
- Tests for "Count of primes in a number grid".
- Tests for "Propositions in Frege’s ideography".
- Tests for "If then else".
- Tests for "Valid brackets in code".
- Tests for "Source code analyser".
- Tests for "3D printer".
- Tests for "2048 scores".
- Tests for "Wine from Kalbodia - episode 1".
- Tests for "2.5D maze".
- Tests for "Minimal number of swaps".
- Tests for "Cylinders".
- Tests for "Killer sudoku solver".
- Tests for "IP mask calculating".
- Tests for "Domino puzzle".
- Tests for "Goldbach’s conjecture".
- Tests for "Let's go to the cinema!".
- Tests for "ASCII ART : glass stacking".
- Tests for "De-FizzBuzzer".
- Tests for "Find the replacement".
- Tests for "The urinal problem".
- Tests for "2×2×2 rubik’s cube movements".
- Tests for "The polish dictionary".
- Tests for "1010(1)".
- Tests for "Vote counting".
- Tests for "Maze for the champions".
- Tests for "Longest increasing subsequence".
- Tests for "Advanced tree".

## [3.16.0] - 2022-12-31
### Added
- Tests for "Sticky keyboard".
- Tests for "Bingo!".
- Tests for "Duck hunt".
- Tests for "Condition overshadowing".
- Tests for "Equalizing arrays".
- Tests for "Level of nested parentheses".
- Tests for "Text alignment".
- Tests for "Elliptic curve cryptography".
- Tests for "Train passenger".
- Tests for "CGS minifier".
- Tests for "Smooth factory".
- Tests for "Sum of divisors".
- Tests for "Numeral system".
- Tests for "Flood fill example".
- Tests for "5D chests".
- Tests for "Near-palindromes".
- Tests for "Reversed look-and-say".
- Tests for "Holey times".
- Tests for "Consecutive balanced substrings".
- Tests for "Palindromic decomposition".
- Tests for "Battleship".
- Tests for "Texas holdem".
- Tests for "Solid integer".
- Tests for "Bit count to limit".
- Tests for "Porcupine fever".
- Tests for "Bijective numeration".
- Tests for "Plight of the fellowship of the ring".
- Tests for "DDCG mapper".
- Tests for "Queneau numbers".
- Tests for "Simple fraction to mixed number".
- Tests for "Rearrange string to two numbers".

### Fixed
- Tests groups for "CGFunge interpreter".

## [3.15.0] - 2022-11-30
### Added
- Tests for "Bulgarian solitaire".
- Tests for "Longest road".
- Tests for "Bruce lee".
- Tests for "Ancestors & descendants".
- Tests for "Paving with bricks".
- Tests for "Playfair cipher".
- Tests for "Barcode scanner".
- Tests for "Length of syracuse conjecture sequence".
- Tests for "Divide the factorial".
- Tests for "Trits (balanced ternary computing)".
- Tests for "Dominoes path".
- Tests for "Hidden word".
- Tests for "Brackets, enhanced edition".
- Tests for "These romans are crazy!".
- Tests for "Virus spreading and clustering".
- Tests for "Suguru solver".
- Tests for "Digit sum successor".
- Tests for "Factorial vs exponential".
- Tests for "Langton's ant".
- Tests for "Anagrams".
- Tests for "The stonemason".
- Tests for "Continued fractions".
- Tests for "All operations are equal!".
- Tests for "Battle tower".
- Tests for "OneWay city".
- Tests for "Plague, jr".
- Tests for "English length units conversion".
- Tests for "Sandpile addition".
- Tests for "Blood types".
- Tests for "Divine!".

### Fixed
- Covers annotation for "The grand festival - II".

## [3.14.0] - 2022-10-31
### Added
- Tests for "A-star exercise".
- Tests for "Othello".
- Tests for "We're going in circles!".
- Tests for "Ascii graph".
- Tests for "Drug interactions".
- Tests for "Gravity centrifuge tuning".
- Tests for "Short accounts make long friends".
- Tests for "Brackets, ultimate edition".
- Tests for "Remaining card".
- Tests for "Surakarta".
- Tests for "Number of letters in a number - Binary".
- Tests for "Counting squares on pegs".
- Tests for "Gravity".
- Tests for "Hacking at RobberCity".
- Tests for "Box of cigars".
- Tests for "Simplified Monopoly™ turns prediction".
- Tests for "Regular polygons".
- Tests for "Horse-hyperracing hyperduals".
- Tests for "3×N tiling".
- Tests for "Hexagonal maze - part2".
- Tests for "Byte pair encoding".
- Tests for "Find the missing plus signs in addition".
- Tests for "Magic stones".
- Tests for "Game of life".
- Tests for "Maximum sub-sequence".
- Tests for "Snake encoding".
- Tests for "Binary search tree traversal".
- Tests for "Gravity centrifuge".
- Tests for "Identifying data structure".
- Tests for "Cards castle".

## [3.13.0] - 2022-09-30
### Added
- Tests for "Locked in gear".
- Tests for "Robbery optimisation".
- Tests for "The voucher".
- Tests for "Connect the hyper-dots".
- Tests for "Rock-paper-scissors war".
- Tests for "Green valleys".
- Tests for "Dungeon 3D".
- Tests for "The grand festival - II".
- Tests for "Quaternion multiplication".
- Tests for "Maze /w teleporters and jumps".
- Tests for "The lost files".
- Tests for "Maze".
- Tests for "Road trip".
- Tests for "2-player game on a calculator".
- Tests for "Derivative time !!! - part1".
- Tests for "Merlin's magic square".
- Tests for "Windmill problem".
- Tests for "Elementary cellular automaton".
- Tests for "Ways to make change".
- Tests for "Brackets, extended edition".
- Tests for "Target firing".
- Tests for "Chained matrix products".
- Tests for "Fun with set theory".
- Tests for "Huffman code".
- Tests for "Number of paths between 2 points".
- Tests for "The lost child.Episode-1".
- Tests for "Gravity tumbler".
- Tests for "Jumping frogs".
- Tests for "Dynamic sorting".

## [3.12.0] - 2022-09-01
### Added
- Tests for "Seam carving".
- Tests for "Rational number tree".
- Tests for "The optimal urinal problem".
- Tests for "Light bulbs".
- Tests for "What the brainfuck !".
- Tests for "Bouncing barry".
- Tests for "Dice probability calculator".
- Tests for "Goro want chocolate".
- Tests for "Photo booth transformation".
- Tests for "Bulls and cows".
- Tests for "CGFunge interpreter".
- Tests for "Sudoku solver".
- Tests for "MCxxxx microcontroller simulation".
- Tests for "Entry code".
- Tests for "L-triominoes".
- Tests for "Paper labyrinth".
- Tests for "Minesweeper".
- Tests for "The grand festival - I".
- Tests for "Depot organization".
- Tests for "Knights jam".
- Tests for "Join the dots".
- Tests for "Circular automation, the period of chaos".
- Tests for "Minimax exercise".
- Tests for "Constrained latin squares".
- Tests for "Crossword".
- Tests for "Futoshiki solver".
- Tests for "Frog exchange".
- Tests for "Fair numbering".
- Tests for "A coin guessing game".
- Tests for "Folding a note".
- Tests for "River crossing".
- Tests for "Mitosis mayhem".

## [3.11.0] - 2022-07-31
### Added
- Tests for "Someone's acting sus....".
- Tests for "Personal best".
- Tests for "Kiss the girls".
- Tests for "Random walk".
- Tests for "Shadow casting".
- Tests for "Fire control".
- Tests for "Genetics and computers - part 1".
- Tests for "Retro typewriter art".
- Tests for "Parse SQL queries".
- Tests for "By train or by car ?".
- Tests for "Low resolution: what's the shape?".
- Tests for "Simple AI duels".
- Tests for "Calculator".
- Tests for "Hello, world!".
- Tests for "Ted's compiler".
- Tests for "Probability for dummies".
- Tests for "Tricky number verifier".
- Tests for "Crop-circles".
- Tests for "Nicholas Breakspeare and Hugh of Evesham".
- Tests for "Nature of triangles".
- Tests for "Artificial emotional intelligence".
- Tests for "Park pilot".
- Tests for "Buzzle".
- Tests for "How time flies".
- Tests for "Minesweeper level generator".
- Tests for "In stereo".
- Tests for "Hooch clash".
- Tests for "Lunar lockout".
- Tests for "Shikaku solver".
- Tests for "Hexagonal maze".
- Tests for "Micro assembly".

### Changed
- Renaming "Linear Bézier curves" to "Cubic Bézier curves".

## [3.10.0] - 2022-06-30
### Added
- Tests for "Markov text generation".
- Tests for "Rectangular block spinner".
- Tests for "Text formatting".
- Tests for "Caesar is the chief".
- Tests for "Moves in maze".
- Tests for "The dart 101".
- Tests for "Survey prediction".
- Tests for "Flip the sign".
- Tests for "The michelangelo code".
- Tests for "Gold packing".
- Tests for "The broken editor".
- Tests for "Substitution encoding".
- Tests for "Monday tuesday happy days".
- Tests for "Magic string".
- Tests for "Robot reach".
- Tests for "IPv6 shortener".
- Tests for "Zhiwei Sun squares".
- Tests for "Stall tilt".
- Tests for "What's so complex about Mandelbrot?".
- Tests for "Auto pickup".
- Tests for "Annihilation".
- Tests for "Faro shuffle".
- Tests for "Morellet’s random lines".
- Tests for "Decode the message".
- Tests for "Detective geek".
- Tests for "Largest number".
- Tests for "Smooth!".
- Tests for "2nd degree polynomial - simple analysis".
- Tests for "Next car license plate ?".

## [3.9.0] - 2022-06-01
### Added
- Tests for "XML MDF-2016".
- Tests for "Brick in the wall".
- Tests for "Frame the picture".
- Tests for "Treasure hunt".
- Tests for "Self-driving car testing".
- Tests for "No more pythons, please!".
- Tests for "TicTacToe".
- Tests for "Number derivation".
- Tests for "Simple auto-scaling".
- Tests for "Horse-racing hyperduals".
- Tests for "Balanced ternary computer: encode".
- Tests for "Extended hamming codes".
- Tests for "Organic compounds".
- Tests for "Nature of quadrilaterals".
- Tests for "A bunny and carrots".
- Tests for "Rugby score".
- Tests for "Mountain map convergence".
- Tests for "Reverse FizzBuzz".
- Tests for "Logic gates".
- Tests for "Master of mayhem".
- Tests for "Body weight is a girl's secret".
- Tests for "Pirate's treasure".
- Tests for "Simple awalé".
- Tests for "Simple load balancing".
- Tests for "Are the clumps normal".
- Tests for "Bulk email generator".
- Tests for "Snail run".
- Tests for "Sweet spot".
- Tests for "Linear Bézier curves".
- Tests for "Disordered first contact".
- Tests for "Cosmic love".
- Tests for "1×1×1 rubik’s cube movements".

## [3.8.0] - 2022-04-30
### Added
- Tests for "Asteroids".
- Tests for "Dungeons and maps".
- Tests for "Encryption/decryption of Enigma machine".
- Tests for "Object insertion".
- Tests for "Bank robbers".
- Tests for "Retaining water".
- Tests for "Graffiti on the fence".
- Tests for "Prefix code".
- Tests for "Offset Arrays".
- Tests for "Unit fractions".
- Tests for "orDer oF succeSsion".
- Tests for "Happy numbers".
- Tests for "Hidden messages in images".
- Tests for "Count as i count".
- Tests for "Logically reasonable inequalities".
- Tests for "Is that a possible word? Ep1".
- Tests for "Unique prefixes".
- Tests for "The mystic rectangle".
- Tests for "The travelling salesman problem".
- Tests for "Murder in the village!".
- Tests for "Dead men's shot".
- Tests for "Darts".
- Tests for "Add'em up".
- Tests for "Rotating arrows".
- Tests for "10 pin bowling scores".
- Tests for "Is the king in check? (part 1)".
- Tests for "A mountain of a mole hill".
- Tests for "Where's Wally".
- Tests for "Feature extraction".
- Tests for "Distributing candy".
- Links to the puzzles on CodinGame.

## [3.7.0] - 2022-03-31
### Added
- Tests for "Credit card verifier (Luhn’s algorithm)".
- Tests for "Van Eck's sequence".
- Tests for "The river I".
- Tests for "The river II".
- Tests for "Tree paths".
- Tests for "Benford's law".
- Tests for "7-segment scanner".
- Tests for "Lumen".
- Tests for "A child's play".
- Tests for "Sum of spiral's diagonals".
- Tests for "Brackets, extreme edition".
- Tests for "The electrician apprentice".
- Tests for "Sudoku validator".
- Tests for "Mountain map".
- Tests for "Create the longest sequence of 1s".
- Tests for "Reverse Minesweeper".
- Tests for "Die handedness".

## [3.6.0] - 2022-03-11
### Added
- Tests for "Walk on a die".
- Tests for "Dolbear's law".
- Tests for "ISBN check digit".
- Tests for "Equivalent resistance, circuit building".
- Tests for "1D spreadsheet".
- Tests for "Ghost legs".
- Tests for "Binary image".
- Tests for "May the Triforce be with you!".
- Tests for "Next growing number".

### Changed
- "STDIN" to "$stdin" in the "Rock paper scissors lizard spock" default code.

## [3.5.0] - 2022-02-22
### Added
- Tests for "1000000000D world".
- Tests for "Rooks movements".
- Tests for "Jack Silver: the casino".
- Tests for "Fax machine".
- Tests for "NGR - basic radar".

## [3.4.0] - 2022-02-21
### Added
- Tests for "1D bush fire".
- Tests for "Blowing fuse".

### Changed
- "@medium" group to enforce time limit.

## [3.3.0] - 2022-02-20
### Added
- Time limit.

## [3.2.0] - 2022-02-18
### Added
- Tests for "Container terminal".
- Tests for "Rectangle partition".
- Tests for "Rock paper scissors lizard spock".

## [3.1.0] - 2022-02-17
### Added
- Tests for "Robot show".

## [3.0.0] - 2022-02-16
### Changed
- Renamed all test files to "CGTest.php".

## [2.8.0] - 2022-02-14
### Added
- Possibility to add tests that do not come from Codingame.

## [2.7.1] - 2022-02-14
### Fixed
- Test group for "Genome sequencing".

## [2.7.0] - 2022-02-14
### Added
- Tests for "Music scores".
- Tests for "The resistance".

## [2.6.0] - 2022-02-14
### Added
- Tests for "Roller coaster".
- Tests for "TAN network".
- Tests for "Blunder - episode 3".
- Tests for "Winamax".

## [2.5.0] - 2022-02-13
### Added
- Tests for "Genome sequencing".
- Tests for "Super computer".

## [2.4.0] - 2022-02-11
### Added
- Tests for "Blunder - episode 2".
- Tests for "CGX formatter".
- Tests for "Surface".

## [2.3.0] - 2022-02-11
### Added
- Tests for "War".
- Tests for "Dwarfs standing on the shoulders of giants".
- Tests for "Network cabling".
- Tests for "Blunder - episode 1".

## [2.2.0] - 2022-02-10
### Added
- Tests for "Conway sequence".
- Tests for "The gift".
- Tests for "Scrabble".

### Fixed
- Test group for "Temperatures".
- Test group for "The gift".

## [2.1.0] - 2022-02-10
### Added
- Tests for "Stock exchange losses".
- Tests for "Telephone numbers".

## [2.0.0] - 2022-02-09
### Changed
- Using "*.dist" files as default PHP templates.

## [1.2.0] - 2022-02-09
### Added
- Tests for "Mayan calculation".

## [1.1.0] - 2022-02-08
### Added
- Tests for "Unary".
- Tests for "Temperatures".
- Tests for "MIME Type".
- Tests for "Defibrillators".

## [1.0.0] - 2022-02-07
### Added
- Base files to the project.
- Tests for "Horse-racing Duals".
- Tests for "ASCII Art".
