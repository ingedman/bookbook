<?php

use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = array(
            0 =>
                array(
                    'author' => 'Chinua Achebe',
                    'country' => 'Nigeria',
                    'imageLink' => 'books/things-fall-apart.jpg',
                    'language' => 'English',
                    'link' => 'https://en.wikipedia.org/wiki/Things_Fall_Apart',
                    'pages' => 209,
                    'title' => 'Things Fall Apart',
                    'year' => 1958,
                ),
            1 =>
                array(
                    'author' => 'Hans Christian Andersen',
                    'country' => 'Denmark',
                    'imageLink' => 'books/fairy-tales.jpg',
                    'language' => 'Danish',
                    'link' => 'https://en.wikipedia.org/wiki/Fairy_Tales_Told_for_Children._First_Collection.',
                    'pages' => 784,
                    'title' => 'Fairy tales',
                    'year' => 1836,
                ),
            2 =>
                array(
                    'author' => 'Dante Alighieri',
                    'country' => 'Italy',
                    'imageLink' => 'books/the-divine-comedy.jpg',
                    'language' => 'Italian',
                    'link' => 'https://en.wikipedia.org/wiki/Divine_Comedy',
                    'pages' => 928,
                    'title' => 'The Divine Comedy',
                    'year' => 1315,
                ),
            3 =>
                array(
                    'author' => 'Unknown',
                    'country' => 'Sumer and Akkadian Empire',
                    'imageLink' => 'books/the-epic-of-gilgamesh.jpg',
                    'language' => 'Akkadian',
                    'link' => 'https://en.wikipedia.org/wiki/Epic_of_Gilgamesh',
                    'pages' => 160,
                    'title' => 'The Epic Of Gilgamesh',
                    'year' => -1700,
                ),
            4 =>
                array(
                    'author' => 'Unknown',
                    'country' => 'Achaemenid Empire',
                    'imageLink' => 'books/the-book-of-job.jpg',
                    'language' => 'Hebrew',
                    'link' => 'https://en.wikipedia.org/wiki/Book_of_Job',
                    'pages' => 176,
                    'title' => 'The Book Of Job',
                    'year' => -600,
                ),
            5 =>
                array(
                    'author' => 'Unknown',
                    'country' => 'India/Iran/Iraq/Egypt/Tajikistan',
                    'imageLink' => 'books/one-thousand-and-one-nights.jpg',
                    'language' => 'Arabic',
                    'link' => 'https://en.wikipedia.org/wiki/One_Thousand_and_One_Nights',
                    'pages' => 288,
                    'title' => 'One Thousand and One Nights',
                    'year' => 1200,
                ),
            6 =>
                array(
                    'author' => 'Unknown',
                    'country' => 'Iceland',
                    'imageLink' => 'books/njals-saga.jpg',
                    'language' => 'Old Norse',
                    'link' => 'https://en.wikipedia.org/wiki/Nj%C3%A1ls_saga',
                    'pages' => 384,
                    'title' => 'Njál\'s Saga',
                    'year' => 1350,
                ),
            7 =>
                array(
                    'author' => 'Jane Austen',
                    'country' => 'United Kingdom',
                    'imageLink' => 'books/pride-and-prejudice.jpg',
                    'language' => 'English',
                    'link' => 'https://en.wikipedia.org/wiki/Pride_and_Prejudice',
                    'pages' => 226,
                    'title' => 'Pride and Prejudice',
                    'year' => 1813,
                ),
            8 =>
                array(
                    'author' => 'Honoré de Balzac',
                    'country' => 'France',
                    'imageLink' => 'books/le-pere-goriot.jpg',
                    'language' => 'French',
                    'link' => 'https://en.wikipedia.org/wiki/Le_P%C3%A8re_Goriot',
                    'pages' => 443,
                    'title' => 'Le Père Goriot',
                    'year' => 1835,
                ),
            9 =>
                array(
                    'author' => 'Samuel Beckett',
                    'country' => 'Republic of Ireland',
                    'imageLink' => 'books/molloy-malone-dies-the-unnamable.jpg',
                    'language' => 'French, English',
                    'link' => 'https://en.wikipedia.org/wiki/Molloy_(novel)',
                    'pages' => 256,
                    'title' => 'Molloy, Malone Dies, The Unnamable, the trilogy',
                    'year' => 1952,
                ),
            10 =>
                array(
                    'author' => 'Giovanni Boccaccio',
                    'country' => 'Italy',
                    'imageLink' => 'books/the-decameron.jpg',
                    'language' => 'Italian',
                    'link' => 'https://en.wikipedia.org/wiki/The_Decameron',
                    'pages' => 1024,
                    'title' => 'The Decameron',
                    'year' => 1351,
                ),
            11 =>
                array(
                    'author' => 'Jorge Luis Borges',
                    'country' => 'Argentina',
                    'imageLink' => 'books/ficciones.jpg',
                    'language' => 'Spanish',
                    'link' => 'https://en.wikipedia.org/wiki/Ficciones',
                    'pages' => 224,
                    'title' => 'Ficciones',
                    'year' => 1965,
                ),
            12 =>
                array(
                    'author' => 'Emily Brontë',
                    'country' => 'United Kingdom',
                    'imageLink' => 'books/wuthering-heights.jpg',
                    'language' => 'English',
                    'link' => 'https://en.wikipedia.org/wiki/Wuthering_Heights',
                    'pages' => 342,
                    'title' => 'Wuthering Heights',
                    'year' => 1847,
                ),
            13 =>
                array(
                    'author' => 'Albert Camus',
                    'country' => 'Algeria, French Empire',
                    'imageLink' => 'books/l-etranger.jpg',
                    'language' => 'French',
                    'link' => 'https://en.wikipedia.org/wiki/The_Stranger_(novel)',
                    'pages' => 185,
                    'title' => 'The Stranger',
                    'year' => 1942,
                ),
            14 =>
                array(
                    'author' => 'Paul Celan',
                    'country' => 'Romania, France',
                    'imageLink' => 'books/poems-paul-celan.jpg',
                    'language' => 'German',
                    'link' => '',
                    'pages' => 320,
                    'title' => 'Poems',
                    'year' => 1952,
                ),
            15 =>
                array(
                    'author' => 'Louis-Ferdinand Céline',
                    'country' => 'France',
                    'imageLink' => 'books/voyage-au-bout-de-la-nuit.jpg',
                    'language' => 'French',
                    'link' => 'https://en.wikipedia.org/wiki/Journey_to_the_End_of_the_Night',
                    'pages' => 505,
                    'title' => 'Journey to the End of the Night',
                    'year' => 1932,
                ),
            16 =>
                array(
                    'author' => 'Miguel de Cervantes',
                    'country' => 'Spain',
                    'imageLink' => 'books/don-quijote-de-la-mancha.jpg',
                    'language' => 'Spanish',
                    'link' => 'https://en.wikipedia.org/wiki/Don_Quixote',
                    'pages' => 1056,
                    'title' => 'Don Quijote De La Mancha',
                    'year' => 1610,
                ),
            17 =>
                array(
                    'author' => 'Geoffrey Chaucer',
                    'country' => 'England',
                    'imageLink' => 'books/the-canterbury-tales.jpg',
                    'language' => 'English',
                    'link' => 'https://en.wikipedia.org/wiki/The_Canterbury_Tales',
                    'pages' => 544,
                    'title' => 'The Canterbury Tales',
                    'year' => 1450,
                ),
            18 =>
                array(
                    'author' => 'Anton Chekhov',
                    'country' => 'Russia',
                    'imageLink' => 'books/stories-of-anton-chekhov.jpg',
                    'language' => 'Russian',
                    'link' => 'https://en.wikipedia.org/wiki/List_of_short_stories_by_Anton_Chekhov',
                    'pages' => 194,
                    'title' => 'Stories',
                    'year' => 1886,
                ),
            19 =>
                array(
                    'author' => 'Joseph Conrad',
                    'country' => 'United Kingdom',
                    'imageLink' => 'books/nostromo.jpg',
                    'language' => 'English',
                    'link' => 'https://en.wikipedia.org/wiki/Nostromo',
                    'pages' => 320,
                    'title' => 'Nostromo',
                    'year' => 1904,
                ),
            20 =>
                array(
                    'author' => 'Charles Dickens',
                    'country' => 'United Kingdom',
                    'imageLink' => 'books/great-expectations.jpg',
                    'language' => 'English',
                    'link' => 'https://en.wikipedia.org/wiki/Great_Expectations',
                    'pages' => 194,
                    'title' => 'Great Expectations',
                    'year' => 1861,
                ),
            21 =>
                array(
                    'author' => 'Denis Diderot',
                    'country' => 'France',
                    'imageLink' => 'books/jacques-the-fatalist.jpg',
                    'language' => 'French',
                    'link' => 'https://en.wikipedia.org/wiki/Jacques_the_Fatalist',
                    'pages' => 596,
                    'title' => 'Jacques the Fatalist',
                    'year' => 1796,
                ),
            22 =>
                array(
                    'author' => 'Alfred Döblin',
                    'country' => 'Germany',
                    'imageLink' => 'books/berlin-alexanderplatz.jpg',
                    'language' => 'German',
                    'link' => 'https://en.wikipedia.org/wiki/Berlin_Alexanderplatz',
                    'pages' => 600,
                    'title' => 'Berlin Alexanderplatz',
                    'year' => 1929,
                ),
            23 =>
                array(
                    'author' => 'Fyodor Dostoevsky',
                    'country' => 'Russia',
                    'imageLink' => 'books/crime-and-punishment.jpg',
                    'language' => 'Russian',
                    'link' => 'https://en.wikipedia.org/wiki/Crime_and_Punishment',
                    'pages' => 551,
                    'title' => 'Crime and Punishment',
                    'year' => 1866,
                ),
            24 =>
                array(
                    'author' => 'Fyodor Dostoevsky',
                    'country' => 'Russia',
                    'imageLink' => 'books/the-idiot.jpg',
                    'language' => 'Russian',
                    'link' => 'https://en.wikipedia.org/wiki/The_Idiot',
                    'pages' => 656,
                    'title' => 'The Idiot',
                    'year' => 1869,
                ),
            25 =>
                array(
                    'author' => 'Fyodor Dostoevsky',
                    'country' => 'Russia',
                    'imageLink' => 'books/the-possessed.jpg',
                    'language' => 'Russian',
                    'link' => 'https://en.wikipedia.org/wiki/Demons_(Dostoyevsky_novel)',
                    'pages' => 768,
                    'title' => 'The Possessed',
                    'year' => 1872,
                ),
            26 =>
                array(
                    'author' => 'Fyodor Dostoevsky',
                    'country' => 'Russia',
                    'imageLink' => 'books/the-brothers-karamazov.jpg',
                    'language' => 'Russian',
                    'link' => 'https://en.wikipedia.org/wiki/The_Brothers_Karamazov',
                    'pages' => 824,
                    'title' => 'The Brothers Karamazov',
                    'year' => 1880,
                ),
            27 =>
                array(
                    'author' => 'George Eliot',
                    'country' => 'United Kingdom',
                    'imageLink' => 'books/middlemarch.jpg',
                    'language' => 'English',
                    'link' => 'https://en.wikipedia.org/wiki/Middlemarch',
                    'pages' => 800,
                    'title' => 'Middlemarch',
                    'year' => 1871,
                ),
            28 =>
                array(
                    'author' => 'Ralph Ellison',
                    'country' => 'United States',
                    'imageLink' => 'books/invisible-man.jpg',
                    'language' => 'English',
                    'link' => 'https://en.wikipedia.org/wiki/Invisible_Man',
                    'pages' => 581,
                    'title' => 'Invisible Man',
                    'year' => 1952,
                ),
            29 =>
                array(
                    'author' => 'Euripides',
                    'country' => 'Greece',
                    'imageLink' => 'books/medea.jpg',
                    'language' => 'Greek',
                    'link' => 'https://en.wikipedia.org/wiki/Medea_(play)',
                    'pages' => 104,
                    'title' => 'Medea',
                    'year' => -431,
                ),
            30 =>
                array(
                    'author' => 'William Faulkner',
                    'country' => 'United States',
                    'imageLink' => 'books/absalom-absalom.jpg',
                    'language' => 'English',
                    'link' => 'https://en.wikipedia.org/wiki/Absalom,_Absalom!',
                    'pages' => 313,
                    'title' => 'Absalom, Absalom!',
                    'year' => 1936,
                ),
            31 =>
                array(
                    'author' => 'William Faulkner',
                    'country' => 'United States',
                    'imageLink' => 'books/the-sound-and-the-fury.jpg',
                    'language' => 'English',
                    'link' => 'https://en.wikipedia.org/wiki/The_Sound_and_the_Fury',
                    'pages' => 326,
                    'title' => 'The Sound and the Fury',
                    'year' => 1929,
                ),
            32 =>
                array(
                    'author' => 'Gustave Flaubert',
                    'country' => 'France',
                    'imageLink' => 'books/madame-bovary.jpg',
                    'language' => 'French',
                    'link' => 'https://en.wikipedia.org/wiki/Madame_Bovary',
                    'pages' => 528,
                    'title' => 'Madame Bovary',
                    'year' => 1857,
                ),
            33 =>
                array(
                    'author' => 'Gustave Flaubert',
                    'country' => 'France',
                    'imageLink' => 'books/l-education-sentimentale.jpg',
                    'language' => 'French',
                    'link' => 'https://en.wikipedia.org/wiki/Sentimental_Education',
                    'pages' => 606,
                    'title' => 'Sentimental Education',
                    'year' => 1869,
                ),
            34 =>
                array(
                    'author' => 'Federico García Lorca',
                    'country' => 'Spain',
                    'imageLink' => 'books/gypsy-ballads.jpg',
                    'language' => 'Spanish',
                    'link' => 'https://en.wikipedia.org/wiki/Gypsy_Ballads',
                    'pages' => 218,
                    'title' => 'Gypsy Ballads',
                    'year' => 1928,
                ),
            35 =>
                array(
                    'author' => 'Gabriel García Márquez',
                    'country' => 'Colombia',
                    'imageLink' => 'books/one-hundred-years-of-solitude.jpg',
                    'language' => 'Spanish',
                    'link' => 'https://en.wikipedia.org/wiki/One_Hundred_Years_of_Solitude',
                    'pages' => 417,
                    'title' => 'One Hundred Years of Solitude',
                    'year' => 1967,
                ),
            36 =>
                array(
                    'author' => 'Gabriel García Márquez',
                    'country' => 'Colombia',
                    'imageLink' => 'books/love-in-the-time-of-cholera.jpg',
                    'language' => 'Spanish',
                    'link' => 'https://en.wikipedia.org/wiki/Love_in_the_Time_of_Cholera',
                    'pages' => 368,
                    'title' => 'Love in the Time of Cholera',
                    'year' => 1985,
                ),
            37 =>
                array(
                    'author' => 'Johann Wolfgang von Goethe',
                    'country' => 'Saxe-Weimar',
                    'imageLink' => 'books/faust.jpg',
                    'language' => 'German',
                    'link' => 'https://en.wikipedia.org/wiki/Goethe%27s_Faust',
                    'pages' => 158,
                    'title' => 'Faust',
                    'year' => 1832,
                ),
            38 =>
                array(
                    'author' => 'Nikolai Gogol',
                    'country' => 'Russia',
                    'imageLink' => 'books/dead-souls.jpg',
                    'language' => 'Russian',
                    'link' => 'https://en.wikipedia.org/wiki/Dead_Souls',
                    'pages' => 432,
                    'title' => 'Dead Souls',
                    'year' => 1842,
                ),
            39 =>
                array(
                    'author' => 'Günter Grass',
                    'country' => 'Germany',
                    'imageLink' => 'books/the-tin-drum.jpg',
                    'language' => 'German',
                    'link' => 'https://en.wikipedia.org/wiki/The_Tin_Drum',
                    'pages' => 600,
                    'title' => 'The Tin Drum',
                    'year' => 1959,
                ),
            40 =>
                array(
                    'author' => 'João Guimarães Rosa',
                    'country' => 'Brazil',
                    'imageLink' => 'books/the-devil-to-pay-in-the-backlands.jpg',
                    'language' => 'Portuguese',
                    'link' => 'https://en.wikipedia.org/wiki/The_Devil_to_Pay_in_the_Backlands',
                    'pages' => 494,
                    'title' => 'The Devil to Pay in the Backlands',
                    'year' => 1956,
                ),
            41 =>
                array(
                    'author' => 'Knut Hamsun',
                    'country' => 'Norway',
                    'imageLink' => 'books/hunger.jpg',
                    'language' => 'Norwegian',
                    'link' => 'https://en.wikipedia.org/wiki/Hunger_(Hamsun_novel)',
                    'pages' => 176,
                    'title' => 'Hunger',
                    'year' => 1890,
                ),
            42 =>
                array(
                    'author' => 'Ernest Hemingway',
                    'country' => 'United States',
                    'imageLink' => 'books/the-old-man-and-the-sea.jpg',
                    'language' => 'English',
                    'link' => 'https://en.wikipedia.org/wiki/The_Old_Man_and_the_Sea',
                    'pages' => 128,
                    'title' => 'The Old Man and the Sea',
                    'year' => 1952,
                ),
            43 =>
                array(
                    'author' => 'Homer',
                    'country' => 'Greece',
                    'imageLink' => 'books/the-iliad-of-homer.jpg',
                    'language' => 'Greek',
                    'link' => 'https://en.wikipedia.org/wiki/Iliad',
                    'pages' => 608,
                    'title' => 'Iliad',
                    'year' => -735,
                ),
            44 =>
                array(
                    'author' => 'Homer',
                    'country' => 'Greece',
                    'imageLink' => 'books/the-odyssey-of-homer.jpg',
                    'language' => 'Greek',
                    'link' => 'https://en.wikipedia.org/wiki/Odyssey',
                    'pages' => 374,
                    'title' => 'Odyssey',
                    'year' => -800,
                ),
            45 =>
                array(
                    'author' => 'Henrik Ibsen',
                    'country' => 'Norway',
                    'imageLink' => 'books/a-Dolls-house.jpg',
                    'language' => 'Norwegian',
                    'link' => 'https://en.wikipedia.org/wiki/A_Doll%27s_House',
                    'pages' => 68,
                    'title' => 'A Doll\'s House',
                    'year' => 1879,
                ),
            46 =>
                array(
                    'author' => 'James Joyce',
                    'country' => 'Irish Free State',
                    'imageLink' => 'books/ulysses.jpg',
                    'language' => 'English',
                    'link' => 'https://en.wikipedia.org/wiki/Ulysses_(novel)',
                    'pages' => 228,
                    'title' => 'Ulysses',
                    'year' => 1922,
                ),
            47 =>
                array(
                    'author' => 'Franz Kafka',
                    'country' => 'Czechoslovakia',
                    'imageLink' => 'books/stories-of-franz-kafka.jpg',
                    'language' => 'German',
                    'link' => 'https://en.wikipedia.org/wiki/Franz_Kafka_bibliography#Short_stories',
                    'pages' => 488,
                    'title' => 'Stories',
                    'year' => 1924,
                ),
            48 =>
                array(
                    'author' => 'Franz Kafka',
                    'country' => 'Czechoslovakia',
                    'imageLink' => 'books/the-trial.jpg',
                    'language' => 'German',
                    'link' => 'https://en.wikipedia.org/wiki/The_Trial',
                    'pages' => 160,
                    'title' => 'The Trial',
                    'year' => 1925,
                ),
            49 =>
                array(
                    'author' => 'Franz Kafka',
                    'country' => 'Czechoslovakia',
                    'imageLink' => 'books/the-castle.jpg',
                    'language' => 'German',
                    'link' => 'https://en.wikipedia.org/wiki/The_Castle_(novel)',
                    'pages' => 352,
                    'title' => 'The Castle',
                    'year' => 1926,
                ),
            50 =>
                array(
                    'author' => 'Kālidāsa',
                    'country' => 'India',
                    'imageLink' => 'books/the-recognition-of-shakuntala.jpg',
                    'language' => 'Sanskrit',
                    'link' => 'https://en.wikipedia.org/wiki/Abhij%C3%B1%C4%81na%C5%9B%C4%81kuntalam',
                    'pages' => 147,
                    'title' => 'The recognition of Shakuntala',
                    'year' => 150,
                ),
            51 =>
                array(
                    'author' => 'Yasunari Kawabata',
                    'country' => 'Japan',
                    'imageLink' => 'books/the-sound-of-the-mountain.jpg',
                    'language' => 'Japanese',
                    'link' => 'https://en.wikipedia.org/wiki/The_Sound_of_the_Mountain',
                    'pages' => 288,
                    'title' => 'The Sound of the Mountain',
                    'year' => 1954,
                ),
            52 =>
                array(
                    'author' => 'Nikos Kazantzakis',
                    'country' => 'Greece',
                    'imageLink' => 'books/zorba-the-greek.jpg',
                    'language' => 'Greek',
                    'link' => 'https://en.wikipedia.org/wiki/Zorba_the_Greek',
                    'pages' => 368,
                    'title' => 'Zorba the Greek',
                    'year' => 1946,
                ),
            53 =>
                array(
                    'author' => 'D. H. Lawrence',
                    'country' => 'United Kingdom',
                    'imageLink' => 'books/sons-and-lovers.jpg',
                    'language' => 'English',
                    'link' => 'https://en.wikipedia.org/wiki/Sons_and_Lovers',
                    'pages' => 432,
                    'title' => 'Sons and Lovers',
                    'year' => 1913,
                ),
            54 =>
                array(
                    'author' => 'Halldór Laxness',
                    'country' => 'Iceland',
                    'imageLink' => 'books/independent-people.jpg',
                    'language' => 'Icelandic',
                    'link' => 'https://en.wikipedia.org/wiki/Independent_People',
                    'pages' => 470,
                    'title' => 'Independent People',
                    'year' => 1934,
                ),
            55 =>
                array(
                    'author' => 'Giacomo Leopardi',
                    'country' => 'Italy',
                    'imageLink' => 'books/poems-giacomo-leopardi.jpg',
                    'language' => 'Italian',
                    'link' => '',
                    'pages' => 184,
                    'title' => 'Poems',
                    'year' => 1818,
                ),
            56 =>
                array(
                    'author' => 'Doris Lessing',
                    'country' => 'United Kingdom',
                    'imageLink' => 'books/the-golden-notebook.jpg',
                    'language' => 'English',
                    'link' => 'https://en.wikipedia.org/wiki/The_Golden_Notebook',
                    'pages' => 688,
                    'title' => 'The Golden Notebook',
                    'year' => 1962,
                ),
            57 =>
                array(
                    'author' => 'Astrid Lindgren',
                    'country' => 'Sweden',
                    'imageLink' => 'books/pippi-longstocking.jpg',
                    'language' => 'Swedish',
                    'link' => 'https://en.wikipedia.org/wiki/Pippi_Longstocking',
                    'pages' => 160,
                    'title' => 'Pippi Longstocking',
                    'year' => 1945,
                ),
            58 =>
                array(
                    'author' => 'Lu Xun',
                    'country' => 'China',
                    'imageLink' => 'books/diary-of-a-madman.jpg',
                    'language' => 'Chinese',
                    'link' => 'https://en.wikipedia.org/wiki/A_Madman%27s_Diary',
                    'pages' => 389,
                    'title' => 'Diary of a Madman',
                    'year' => 1918,
                ),
            59 =>
                array(
                    'author' => 'Naguib Mahfouz',
                    'country' => 'Egypt',
                    'imageLink' => 'books/children-of-gebelawi.jpg',
                    'language' => 'Arabic',
                    'link' => 'https://en.wikipedia.org/wiki/Children_of_Gebelawi',
                    'pages' => 355,
                    'title' => 'Children of Gebelawi',
                    'year' => 1959,
                ),
            60 =>
                array(
                    'author' => 'Thomas Mann',
                    'country' => 'Germany',
                    'imageLink' => 'books/buddenbrooks.jpg',
                    'language' => 'German',
                    'link' => 'https://en.wikipedia.org/wiki/Buddenbrooks',
                    'pages' => 736,
                    'title' => 'Buddenbrooks',
                    'year' => 1901,
                ),
            61 =>
                array(
                    'author' => 'Thomas Mann',
                    'country' => 'Germany',
                    'imageLink' => 'books/the-magic-mountain.jpg',
                    'language' => 'German',
                    'link' => 'https://en.wikipedia.org/wiki/The_Magic_Mountain',
                    'pages' => 720,
                    'title' => 'The Magic Mountain',
                    'year' => 1924,
                ),
            62 =>
                array(
                    'author' => 'Herman Melville',
                    'country' => 'United States',
                    'imageLink' => 'books/moby-dick.jpg',
                    'language' => 'English',
                    'link' => 'https://en.wikipedia.org/wiki/Moby-Dick',
                    'pages' => 378,
                    'title' => 'Moby Dick',
                    'year' => 1851,
                ),
            63 =>
                array(
                    'author' => 'Michel de Montaigne',
                    'country' => 'France',
                    'imageLink' => 'books/essais.jpg',
                    'language' => 'French',
                    'link' => 'https://en.wikipedia.org/wiki/Essays_(Montaigne)',
                    'pages' => 404,
                    'title' => 'Essays',
                    'year' => 1595,
                ),
            64 =>
                array(
                    'author' => 'Elsa Morante',
                    'country' => 'Italy',
                    'imageLink' => 'books/history.jpg',
                    'language' => 'Italian',
                    'link' => 'https://en.wikipedia.org/wiki/History_(novel)',
                    'pages' => 600,
                    'title' => 'History',
                    'year' => 1974,
                ),
            65 =>
                array(
                    'author' => 'Toni Morrison',
                    'country' => 'United States',
                    'imageLink' => 'books/beloved.jpg',
                    'language' => 'English',
                    'link' => 'https://en.wikipedia.org/wiki/Beloved_(novel)',
                    'pages' => 321,
                    'title' => 'Beloved',
                    'year' => 1987,
                ),
            66 =>
                array(
                    'author' => 'Murasaki Shikibu',
                    'country' => 'Japan',
                    'imageLink' => 'books/the-tale-of-genji.jpg',
                    'language' => 'Japanese',
                    'link' => 'https://en.wikipedia.org/wiki/The_Tale_of_Genji',
                    'pages' => 1360,
                    'title' => 'The Tale of Genji',
                    'year' => 1006,
                ),
            67 =>
                array(
                    'author' => 'Robert Musil',
                    'country' => 'Austria',
                    'imageLink' => 'books/the-man-without-qualities.jpg',
                    'language' => 'German',
                    'link' => 'https://en.wikipedia.org/wiki/The_Man_Without_Qualities',
                    'pages' => 365,
                    'title' => 'The Man Without Qualities',
                    'year' => 1931,
                ),
            68 =>
                array(
                    'author' => 'Vladimir Nabokov',
                    'country' => 'Russia/United States',
                    'imageLink' => 'books/lolita.jpg',
                    'language' => 'English',
                    'link' => 'https://en.wikipedia.org/wiki/Lolita',
                    'pages' => 317,
                    'title' => 'Lolita',
                    'year' => 1955,
                ),
            69 =>
                array(
                    'author' => 'George Orwell',
                    'country' => 'United Kingdom',
                    'imageLink' => 'books/nineteen-eighty-four.jpg',
                    'language' => 'English',
                    'link' => 'https://en.wikipedia.org/wiki/Nineteen_Eighty-Four',
                    'pages' => 272,
                    'title' => 'Nineteen Eighty-Four',
                    'year' => 1949,
                ),
            70 =>
                array(
                    'author' => 'Ovid',
                    'country' => 'Roman Empire',
                    'imageLink' => 'books/the-metamorphoses-of-ovid.jpg',
                    'language' => 'Classical Latin',
                    'link' => 'https://en.wikipedia.org/wiki/Metamorphoses',
                    'pages' => 576,
                    'title' => 'Metamorphoses',
                    'year' => 100,
                ),
            71 =>
                array(
                    'author' => 'Fernando Pessoa',
                    'country' => 'Portugal',
                    'imageLink' => 'books/the-book-of-disquiet.jpg',
                    'language' => 'Portuguese',
                    'link' => 'https://en.wikipedia.org/wiki/The_Book_of_Disquiet',
                    'pages' => 272,
                    'title' => 'The Book of Disquiet',
                    'year' => 1928,
                ),
            72 =>
                array(
                    'author' => 'Edgar Allan Poe',
                    'country' => 'United States',
                    'imageLink' => 'books/tales-and-poems-of-edgar-allan-poe.jpg',
                    'language' => 'English',
                    'link' => 'https://en.wikipedia.org/wiki/Edgar_Allan_Poe_bibliography#Tales',
                    'pages' => 842,
                    'title' => 'Tales',
                    'year' => 1950,
                ),
            73 =>
                array(
                    'author' => 'Marcel Proust',
                    'country' => 'France',
                    'imageLink' => 'books/a-la-recherche-du-temps-perdu.jpg',
                    'language' => 'French',
                    'link' => 'https://en.wikipedia.org/wiki/In_Search_of_Lost_Time',
                    'pages' => 2408,
                    'title' => 'In Search of Lost Time',
                    'year' => 1920,
                ),
            74 =>
                array(
                    'author' => 'François Rabelais',
                    'country' => 'France',
                    'imageLink' => 'books/gargantua-and-pantagruel.jpg',
                    'language' => 'French',
                    'link' => 'https://en.wikipedia.org/wiki/Gargantua_and_Pantagruel',
                    'pages' => 623,
                    'title' => 'Gargantua and Pantagruel',
                    'year' => 1533,
                ),
            75 =>
                array(
                    'author' => 'Juan Rulfo',
                    'country' => 'Mexico',
                    'imageLink' => 'books/pedro-paramo.jpg',
                    'language' => 'Spanish',
                    'link' => 'https://en.wikipedia.org/wiki/Pedro_P%C3%A1ramo',
                    'pages' => 124,
                    'title' => 'Pedro Páramo',
                    'year' => 1955,
                ),
            76 =>
                array(
                    'author' => 'Rumi',
                    'country' => 'Sultanate of Rum',
                    'imageLink' => 'books/the-masnavi.jpg',
                    'language' => 'Persian',
                    'link' => 'https://en.wikipedia.org/wiki/Masnavi',
                    'pages' => 438,
                    'title' => 'The Masnavi',
                    'year' => 1236,
                ),
            77 =>
                array(
                    'author' => 'Salman Rushdie',
                    'country' => 'United Kingdom, India',
                    'imageLink' => 'books/midnights-children.jpg',
                    'language' => 'English',
                    'link' => 'https://en.wikipedia.org/wiki/Midnight%27s_Children',
                    'pages' => 536,
                    'title' => 'Midnight\'s Children',
                    'year' => 1981,
                ),
            78 =>
                array(
                    'author' => 'Saadi',
                    'country' => 'Persia, Persian Empire',
                    'imageLink' => 'books/bostan.jpg',
                    'language' => 'Persian',
                    'link' => 'https://en.wikipedia.org/wiki/Bustan_(book)',
                    'pages' => 298,
                    'title' => 'Bostan',
                    'year' => 1257,
                ),
            79 =>
                array(
                    'author' => 'Tayeb Salih',
                    'country' => 'Sudan',
                    'imageLink' => 'books/season-of-migration-to-the-north.jpg',
                    'language' => 'Arabic',
                    'link' => 'https://en.wikipedia.org/wiki/Season_of_Migration_to_the_North',
                    'pages' => 139,
                    'title' => 'Season of Migration to the North',
                    'year' => 1966,
                ),
            80 =>
                array(
                    'author' => 'José Saramago',
                    'country' => 'Portugal',
                    'imageLink' => 'books/blindness.jpg',
                    'language' => 'Portuguese',
                    'link' => 'https://en.wikipedia.org/wiki/Blindness_(novel)',
                    'pages' => 352,
                    'title' => 'Blindness',
                    'year' => 1995,
                ),
            81 =>
                array(
                    'author' => 'William Shakespeare',
                    'country' => 'England',
                    'imageLink' => 'books/hamlet.jpg',
                    'language' => 'English',
                    'link' => 'https://en.wikipedia.org/wiki/Hamlet',
                    'pages' => 432,
                    'title' => 'Hamlet',
                    'year' => 1603,
                ),
            82 =>
                array(
                    'author' => 'William Shakespeare',
                    'country' => 'England',
                    'imageLink' => 'books/king-lear.jpg',
                    'language' => 'English',
                    'link' => 'https://en.wikipedia.org/wiki/King_Lear',
                    'pages' => 384,
                    'title' => 'King Lear',
                    'year' => 1608,
                ),
            83 =>
                array(
                    'author' => 'William Shakespeare',
                    'country' => 'England',
                    'imageLink' => 'books/othello.jpg',
                    'language' => 'English',
                    'link' => 'https://en.wikipedia.org/wiki/Othello',
                    'pages' => 314,
                    'title' => 'Othello',
                    'year' => 1609,
                ),
            84 =>
                array(
                    'author' => 'Sophocles',
                    'country' => 'Greece',
                    'imageLink' => 'books/oedipus-the-king.jpg',
                    'language' => 'Greek',
                    'link' => 'https://en.wikipedia.org/wiki/Oedipus_the_King',
                    'pages' => 88,
                    'title' => 'Oedipus the King',
                    'year' => -430,
                ),
            85 =>
                array(
                    'author' => 'Stendhal',
                    'country' => 'France',
                    'imageLink' => 'books/le-rouge-et-le-noir.jpg',
                    'language' => 'French',
                    'link' => 'https://en.wikipedia.org/wiki/The_Red_and_the_Black',
                    'pages' => 576,
                    'title' => 'The Red and the Black',
                    'year' => 1830,
                ),
            86 =>
                array(
                    'author' => 'Laurence Sterne',
                    'country' => 'England',
                    'imageLink' => 'books/the-life-and-opinions-of-tristram-shandy.jpg',
                    'language' => 'English',
                    'link' => 'https://en.wikipedia.org/wiki/The_Life_and_Opinions_of_Tristram_Shandy,_Gentleman',
                    'pages' => 640,
                    'title' => 'The Life And Opinions of Tristram Shandy',
                    'year' => 1760,
                ),
            87 =>
                array(
                    'author' => 'Italo Svevo',
                    'country' => 'Italy',
                    'imageLink' => 'books/confessions-of-zeno.jpg',
                    'language' => 'Italian',
                    'link' => 'https://en.wikipedia.org/wiki/Zeno%27s_Conscience',
                    'pages' => 412,
                    'title' => 'Confessions of Zeno',
                    'year' => 1923,
                ),
            88 =>
                array(
                    'author' => 'Jonathan Swift',
                    'country' => 'Ireland',
                    'imageLink' => 'books/gullivers-travels.jpg',
                    'language' => 'English',
                    'link' => 'https://en.wikipedia.org/wiki/Gulliver%27s_Travels',
                    'pages' => 178,
                    'title' => 'Gulliver\'s Travels',
                    'year' => 1726,
                ),
            89 =>
                array(
                    'author' => 'Leo Tolstoy',
                    'country' => 'Russia',
                    'imageLink' => 'books/war-and-peace.jpg',
                    'language' => 'Russian',
                    'link' => 'https://en.wikipedia.org/wiki/War_and_Peace',
                    'pages' => 1296,
                    'title' => 'War and Peace',
                    'year' => 1867,
                ),
            90 =>
                array(
                    'author' => 'Leo Tolstoy',
                    'country' => 'Russia',
                    'imageLink' => 'books/anna-karenina.jpg',
                    'language' => 'Russian',
                    'link' => 'https://en.wikipedia.org/wiki/Anna_Karenina',
                    'pages' => 864,
                    'title' => 'Anna Karenina',
                    'year' => 1877,
                ),
            91 =>
                array(
                    'author' => 'Leo Tolstoy',
                    'country' => 'Russia',
                    'imageLink' => 'books/the-death-of-ivan-ilyich.jpg',
                    'language' => 'Russian',
                    'link' => 'https://en.wikipedia.org/wiki/The_Death_of_Ivan_Ilyich',
                    'pages' => 92,
                    'title' => 'The Death of Ivan Ilyich',
                    'year' => 1886,
                ),
            92 =>
                array(
                    'author' => 'Mark Twain',
                    'country' => 'United States',
                    'imageLink' => 'books/the-adventures-of-huckleberry-finn.jpg',
                    'language' => 'English',
                    'link' => 'https://en.wikipedia.org/wiki/Adventures_of_Huckleberry_Finn',
                    'pages' => 224,
                    'title' => 'The Adventures of Huckleberry Finn',
                    'year' => 1884,
                ),
            93 =>
                array(
                    'author' => 'Valmiki',
                    'country' => 'India',
                    'imageLink' => 'books/ramayana.jpg',
                    'language' => 'Sanskrit',
                    'link' => 'https://en.wikipedia.org/wiki/Ramayana',
                    'pages' => 152,
                    'title' => 'Ramayana',
                    'year' => -450,
                ),
            94 =>
                array(
                    'author' => 'Virgil',
                    'country' => 'Roman Empire',
                    'imageLink' => 'books/the-aeneid.jpg',
                    'language' => 'Classical Latin',
                    'link' => 'https://en.wikipedia.org/wiki/Aeneid',
                    'pages' => 442,
                    'title' => 'The Aeneid',
                    'year' => -23,
                ),
            95 =>
                array(
                    'author' => 'Vyasa',
                    'country' => 'India',
                    'imageLink' => 'books/the-mahab-harata.jpg',
                    'language' => 'Sanskrit',
                    'link' => 'https://en.wikipedia.org/wiki/Mahabharata',
                    'pages' => 276,
                    'title' => 'Mahabharata',
                    'year' => -700,
                ),
            96 =>
                array(
                    'author' => 'Walt Whitman',
                    'country' => 'United States',
                    'imageLink' => 'books/leaves-of-grass.jpg',
                    'language' => 'English',
                    'link' => 'https://en.wikipedia.org/wiki/Leaves_of_Grass',
                    'pages' => 152,
                    'title' => 'Leaves of Grass',
                    'year' => 1855,
                ),
            97 =>
                array(
                    'author' => 'Virginia Woolf',
                    'country' => 'United Kingdom',
                    'imageLink' => 'books/mrs-dalloway.jpg',
                    'language' => 'English',
                    'link' => 'https://en.wikipedia.org/wiki/Mrs_Dalloway',
                    'pages' => 216,
                    'title' => 'Mrs Dalloway',
                    'year' => 1925,
                ),
            98 =>
                array(
                    'author' => 'Virginia Woolf',
                    'country' => 'United Kingdom',
                    'imageLink' => 'books/to-the-lighthouse.jpg',
                    'language' => 'English',
                    'link' => 'https://en.wikipedia.org/wiki/To_the_Lighthouse',
                    'pages' => 209,
                    'title' => 'To the Lighthouse',
                    'year' => 1927,
                ),
            99 =>
                array(
                    'author' => 'Marguerite Yourcenar',
                    'country' => 'France/Belgium',
                    'imageLink' => 'books/memoirs-of-hadrian.jpg',
                    'language' => 'French',
                    'link' => 'https://en.wikipedia.org/wiki/Memoirs_of_Hadrian',
                    'pages' => 408,
                    'title' => 'Memoirs of Hadrian',
                    'year' => 1951,
                ),
        );

        foreach ($books as $book) {
            // todo: add languages
            $author=factory(App\Author::class)->create([
                'name' => $book['author'],
                'language_id' => function () {
                    return \App\Language::inRandomOrder()->first()->id;
                }
            ]);

            $createdBook =factory(App\Book::class)->create([
                'title' => $book['title'],
                'year' => $book['year'],
                'cover' => $book['imageLink'],
                'poster_id' => function () {
                    return \App\User::inRandomOrder()->first()->id;
                }
            ]);
            $createdBook->authors()->attach($author);
        }
    }
}
