<?php

require_once __DIR__ . '/dbh.inc.php';

function tideman($candidates, $votes) {
    $candidate_count = count($candidates);
    $preferences = array_fill(0, $candidate_count, array_fill(0, $candidate_count, 0));
    $locked = array_fill(0, $candidate_count, array_fill(0, $candidate_count, false));
    $pair_count = 0;

    // Function to update ranks given a new vote
    function vote($rank, $name, &$ranks, $candidates) {
        $index = array_search($name, $candidates);
        if ($index !== false) {
            $ranks[$rank] = $index;
            return true;
        }
        return false;
    }

    // Function to update preferences given one voter's ranks
    function record_preferences($ranks, &$preferences) {
        $candidate_count = count($ranks);
        for ($i = 0; $i < $candidate_count; $i++) {
            for ($j = $i + 1; $j < $candidate_count; $j++) {
                $preferences[$ranks[$i]][$ranks[$j]]++;
            }
        }
    }

    // Function to record pairs of candidates where one is preferred over the other
    function add_pairs(&$pairs, &$pair_count, $preferences, $candidates) {
        $candidate_count = count($candidates);
        for ($i = 0; $i < $candidate_count; $i++) {
            for ($j = $i + 1; $j < $candidate_count; $j++) {
                if ($preferences[$i][$j] > $preferences[$j][$i]) {
                    $pairs[$pair_count]['winner'] = $i;
                    $pairs[$pair_count]['loser'] = $j;
                    $pair_count++;
                } elseif ($preferences[$i][$j] < $preferences[$j][$i]) {
                    $pairs[$pair_count]['winner'] = $j;
                    $pairs[$pair_count]['loser'] = $i;
                    $pair_count++;
                }
            }
        }
    }

    // Function to sort pairs in decreasing order by strength of victory
    function sort_pairs(&$pairs, $pair_count, &$preferences) {
        usort($pairs, function($a, $b) use ($preferences) {
            return $preferences[$b['winner']][$b['loser']] - $preferences[$a['winner']][$a['loser']];
        });
    }

    // Function to check if locking a pair would create a cycle
    function has_cycle($winner, $loser, &$locked, $candidate_count) {
        while ($winner !== -1 && $winner !== $loser) {
            $found = false;
            for ($i = 0; $i < $candidate_count; $i++) {
                if ($locked[$i][$winner]) {
                    $found = true;
                    $winner = $i;
                }
            }
            if (!$found) {
                $winner = -1;
            }
        }
        return $winner === $loser;
    }

    // Function to lock pairs into the candidate graph in order, without creating cycles
    function lock_pairs(&$locked, &$pairs, $pair_count, $candidate_count) {
        for ($i = 0; $i < $pair_count; $i++) {
            if (!has_cycle($pairs[$i]['winner'], $pairs[$i]['loser'], $locked, $candidate_count)) {
                $locked[$pairs[$i]['winner']][$pairs[$i]['loser']] = true;
            }
        }
    }

    // Function to print the winner of the election
    function print_winner($locked, $candidates) {
        $candidate_count = count($candidates);
        for ($col = 0; $col < $candidate_count; $col++) {
            $found_source = true;
            for ($row = 0; $row < $candidate_count; $row++) {
                if ($locked[$row][$col]) {
                    $found_source = false;
                    break;
                }
            }
            if ($found_source) {
                return $candidates[$col];
            }
        }
        return null;
    }

    $voter_count = count($votes);

    // Process votes
    for ($i = 0; $i < $voter_count; $i++) {
        $ranks = array_fill(0, $candidate_count, 0);
        foreach ($votes[$i] as $rank => $name) {
            if (!vote($rank, $name, $ranks, $candidates)) {
                return "Invalid vote.";
            }
        }
        record_preferences($ranks, $preferences);
    }

    add_pairs($pairs, $pair_count, $preferences, $candidates);
    sort_pairs($pairs, $pair_count, $preferences);
    lock_pairs($locked, $pairs, $pair_count, $candidate_count);
    return print_winner($locked, $candidates);
}
function calculateWinningBallot($pdo, $box_id) {
    // Fetch candidates and ballots for the given box_id
    $stmt = $pdo->prepare("SELECT id FROM ballots WHERE box_id = :box_id");
    $stmt->bindParam(':box_id', $box_id);
    $stmt->execute();
    $ballots = $stmt->fetchAll(PDO::FETCH_COLUMN);

    
    $rankedBallots = getBallotDataByBoxId($pdo, $box_id);

    // print_r($ballots);
    // echo '<br';
    // print_r($rankedBallots);
    // die();

    // Calculate the winning ballot using Tideman's algorithm
    $winner = tideman($ballots, $rankedBallots);
    return $winner;
}
function getBallotDataByBoxId($pdo, $boxId) {
    $stmt = $pdo->prepare("SELECT user_id, GROUP_CONCAT(ballot_id ORDER BY rank) as ordered_ballots
                           FROM votes
                           WHERE box_id = :boxId
                           GROUP BY user_id
                           ORDER BY user_id");
    $stmt->execute(['boxId' => $boxId]);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $formattedResult = [];
    
    foreach ($result as $row) {
        $ballotIds = explode(',', $row['ordered_ballots']);
        $formattedResult[] = $ballotIds;
    }

    return $formattedResult;
}