<?php
$html = file_get_contents('ddg_out.html');

preg_match_all('/<td class=\'result-snippet\'[^>]*>(.*?)<\/td>/is', $html, $snippetMatches);
print_r(count($snippetMatches[1]) . " snippets\n");

preg_match_all('/<a rel="nofollow" href="([^"]+)"[^>]*>(.*?)<\/a>/is', $html, $linkMatches);
print_r(count($linkMatches[1]) . " links\n");

for ($i = 0; $i < min(count($linkMatches[1]), 3); $i++) {
    echo "Title: " . strip_tags($linkMatches[2][$i]) . "\n";
    echo "Link: " . $linkMatches[1][$i] . "\n";
    echo "Snippet: " . strip_tags($snippetMatches[1][$i]) . "\n\n";
}
