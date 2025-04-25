<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $media['title'] }} - Movie Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .poster {
            max-width: 200px;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        .rating-score {
            font-weight: bold;
            color: #e67e22;
        }
        .tagline {
            font-style: italic;
            text-align: center;
            margin: 20px 0;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ $media['title'] }} ({{ date('Y', strtotime($media['release_date'])) }})</h1>
        
        <p class="tagline">{{ $media['tagline'] }}</p>
        
        @if($media['poster_path'])
            <img src="https://image.tmdb.org/t/p/original{{ $media['poster_path'] }}" alt="{{ $media['title'] }} poster" class="poster">
        @endif
        
        <h2>Movie Details</h2>
        <table>
            <tr>
                <th>Director</th>
                <td>{{ $media['director'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Release Date</th>
                <td>{{ date('F j, Y', strtotime($media['release_date'])) }}</td>
            </tr>
            <tr>
                <th>Runtime</th>
                <td>{{ floor($media['runtime'] / 60) }}h {{ $media['runtime'] % 60 }}m</td>
            </tr>
            <tr>
                <th>Genres</th>
                <td>
                    @foreach($media['genres'] as $genre)
                        {{ $genre['name'] }}@if(!$loop->last), @endif
                    @endforeach
                </td>
            </tr>
            <tr>
                <th>Budget</th>
                <td>${{ number_format($media['budget']) }}</td>
            </tr>
            <tr>
                <th>Revenue</th>
                <td>${{ number_format($media['revenue']) }}</td>
            </tr>
            <tr>
                <th>Overview</th>
                <td>{{ $media['overview'] }}</td>
            </tr>
        </table>
        
        <h2>Ratings</h2>
        <table>
            <tr>
                <th>Source</th>
                <th>Score</th>
                <th>Reviews Count</th>
                <th>Link</th>
            </tr>
            @foreach($ratings as $source => $rating)
                @if($rating && isset($rating['score']))
                    <tr>
                        <td>{{ ucfirst(str_replace('_', ' ', $source)) }}</td>
                        <td class="rating-score">{{ $rating['score'] }}</td>
                        <td>
                            @if(isset($rating['reviewsCount']))
                                {{ number_format($rating['reviewsCount']) }}
                            @elseif(isset($rating['audienceScoreReviewsCount']))
                                {{ number_format($rating['audienceScoreReviewsCount']) }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @if(isset($rating['url']))
                                <a href="{{ $rating['url'] }}" target="_blank">View</a>
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                @endif
            @endforeach
            <tr>
                <td><strong>Average</strong></td>
                <td class="rating-score">{{ $ratings['average']['score'] }}</td>
                <td></td>
                <td></td>
            </tr>
        </table>
        
        @if(isset($media['external_ids']))
            <h2>External Links</h2>
            <table>
                @foreach($media['external_ids'] as $key => $value)
                    @if($value && !in_array($key, ['imdb_id', 'wikidata_id']))
                        <tr>
                            <th>{{ ucfirst(str_replace('_', ' ', $key)) }}</th>
                            <td>
                                @if($key === 'facebook_id' && $value)
                                    <a href="https://facebook.com/{{ $value }}" target="_blank">Facebook Page</a>
                                @elseif($value)
                                    {{ $value }}
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <th>IMDb</th>
                    <td><a href="https://www.imdb.com/title/{{ $media['external_ids']['imdb_id'] }}" target="_blank">IMDb Page</a></td>
                </tr>
                <tr>
                    <th>Wikidata</th>
                    <td><a href="https://www.wikidata.org/wiki/{{ $media['external_ids']['wikidata_id'] }}" target="_blank">Wikidata Entry</a></td>
                </tr>
            </table>
        @endif
    </div>
</body>
</html>