<?php

declare(strict_types=1);

namespace CyrilVerloop\Codingame\Training\Medium\MayanCalculation;

use CyrilVerloop\Codingame\Puzzle;

/**
 * The "Mayan calculation" puzzle.
 */
class MayanCalculation implements Puzzle
{
    // Methods :

    public function execute($stdin): void
    {
        fscanf($stdin, "%d %d", $L, $H);
        for ($i = 0; $i < $H; $i++)
        {
            fscanf($stdin, "%s", $numeral);
        }
        fscanf($stdin, "%d", $S1);
        for ($i = 0; $i < $S1; $i++)
        {
            fscanf($stdin, "%s", $num1Line);
        }
        fscanf($stdin, "%d", $S2);
        for ($i = 0; $i < $S2; $i++)
        {
            fscanf($stdin, "%s", $num2Line);
        }
        fscanf($stdin, "%s", $operation);

        // Write an answer using echo(). DON'T FORGET THE TRAILING \n

        echo("result\n");
    }
}
