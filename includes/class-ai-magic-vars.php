<?php

$modelOptions = array(
    'GPT-3 Complete' => array(

        'text-davinci-003' => array(
            'name' => 'text-davinci-003',
            'description' => 'Most capable model in the series. Can perform any task the other GPT-3 models can, often with higher quality, longer output and better instruction-following. It can process up to 4,000 tokens per request.',
            // 'max_tokens' => // TODO: Add max_tokens value
        ),

        'text-davinci-002' => array(
            'name' => 'text-davinci-002',
            'description' => 'Second generation model in the series. Can perform any task the earlier GPT-3 models can, often with less context. It can process up to 4,000 tokens per request.',
            // 'max_tokens' => // TODO: Add max_tokens value
        ),

        'text-davinci-001' => array(
            'name' => 'text-davinci-001',
            'description' => 'Older version of the most capable model in the series. Can perform any task the other GPT-3 models can, often with less context.',
            // 'max_tokens' => // TODO: Add max_tokens value
        ),
        
        'text-curie-001' => array(
            'name' => 'text-curie-001',
            'description' => 'Very capable, but faster and lower cost than text-davinci-003.',
            // 'max_tokens' => // TODO: Add max_tokens value
        ),

        'text-babbage-001' => array(
            'name' => 'text-babbage-001',
            'description' => 'Capable of straightforward tasks, very fast, and lower cost.',
            // 'max_tokens' => // TODO: Add max_tokens value
        ),

        'text-ada-001' => array(
            'name' => 'text-ada-001',
            'description' => 'Capable of simple tasks, usually the fastest model in the series, and lowest cost.',
            // 'max_tokens' => // TODO: Add max_tokens value
        ),
        
        'code-davinci-001' => array(
            'name' => 'code-davinci-001',
            'description' => 'Older version of the most capable model in the series, which can understand and generate code, including translating natural language to code. Its per-request token limit is double the usual limit (4,096 tokens instead of 2,048).',
            // 'max_tokens' => // TODO: Add max_tokens value
        ),

        'davinci-instruct-beta' => array(
            'name' => 'davinci-instruct-beta',
            'description' => '',
            // 'max_tokens' => // TODO: Add max_tokens value
        ),

        'davinci' => array(
            'name' => 'davinci',
            'description' => '',
            // 'max_tokens' => // TODO: Add max_tokens value
        ),
        'curie-instruct-beta' => array(
            'name' => 'curie-instruct-beta',
            'description' => '',
            // 'max_tokens' => // TODO: Add max_tokens value
        ),

        'curie' => array(
            'name' => 'curie',
            'description' => '',
            // 'max_tokens' => // TODO: Add max_tokens value
        ),

        'babbage' => array(
            'name' => 'babbage',
            'description' => '',
            // 'max_tokens' => // TODO: Add max_tokens value
        ),

        'ada' => array(
            'name' => 'ada',
            'description' => '',
            // 'max_tokens' => // TODO: Add max_tokens value
        ),

        'gpt-3.5-turbo-instruct-0914' => array(
            'name' => 'gpt-3.5-turbo-instruct-0914',
            'description' => '',
            // 'max_tokens' => // TODO: Add max_tokens value
        ),

        'gpt-3.5-turbo-instruct' => array(
            'name' => 'gpt-3.5-turbo-instruct',
            'description' => '',
            // 'max_tokens' => // TODO: Add max_tokens value
        ),

        'babbage-002' => array(
            'name' => 'babbage-002',
            'description' => '',
            // 'max_tokens' => // TODO: Add max_tokens value
        ),

        'davinci-002' => array(
            'name' => 'davinci-002',
            'description' => '',
            // 'max_tokens' => // TODO: Add max_tokens value
        ),
    ),
    'Chat' => array(
        'gpt-4-0613' => array(
            'name' => 'gpt-4-0613',
            'description' => 'Another variant of the GPT-4 series tailored for specific applications.',
            'max_tokens' => 8192
        ),
        'gpt-4-0314' => array(
            'name' => 'gpt-4-0314',
            'description' => 'A specific configuration of the GPT-4 model optimized for various tasks.',
            'max_tokens' => 8192
        ),
        'gpt-4' => array(
            'name' => 'gpt-4',
            'description' => 'The fourth iteration of the GPT series with improved performance and capabilities.',
            'max_tokens' => 8192
        ),
        'gpt-3.5-turbo-16k-0613' => array(
            'name' => 'gpt-3.5-turbo-16k-0613',
            'description' => 'A specific variant of the GPT-3.5 Turbo 16k model with unique optimizations.',
            'max_tokens' => 16385
        ),
        'gpt-3.5-turbo-16k' => array(
            'name' => 'gpt-3.5-turbo-16k',
            'description' => 'A high-capacity version of the GPT-3.5 Turbo model for handling larger data sets.',
            'max_tokens' => 16385
        ),
        'gpt-3.5-turbo-0613' => array(
            'name' => 'gpt-3.5-turbo-0613',
            'description' => 'A specific variant of the GPT-3.5 Turbo 16k model with unique optimizations.',
            'max_tokens' => 16385
        ),
        'gpt-3.5-turbo-0301' => array(
            'name' => 'gpt-3.5-turbo-0301',
            'description' => 'A specific configuration of the GPT-3.5 Turbo model for certain tasks.',
            'max_tokens' => 4097
        ),
        'gpt-3.5-turbo' => array(
            'name' => 'gpt-3.5-turbo',
            'description' => 'An intermediate version between GPT-3 and GPT-4, optimized for faster performance.',
            'max_tokens' => 4097
        ),
    ),
);

$modelEngines = array(
    'davinci' => 'davinci',
);

$languageOptions = array(
    "de" => "Deutsch",
    "en" => "English",
    "es" => "español",
    "es-419" => "español (Latinoamérica)",
    "fr" => "français",
    "hr" => "hrvatski",
    "it" => "italiano",
    "nl" => "Nederlands",
    "pl" => "polski",
    "pt-BR" => "português (Brasil)",
    "pt-PT" => "português (Portugal)",
    "vi" => "Tiếng Việt",
    "tr" => "Türkçe",
    "ru" => "русский",
    "ar" => "العربية",
    "th" => "ไทย",
    "ko" => "한국어",
    "zh-CN" => "中文 (简体)",
    "zh-TW" => "中文 (繁體)",
    "zh-HK" => "香港中文",
    "ja" => "日本語",
    "ach" => "Acoli",
    "af" => "Afrikaans",
    "ak" => "Akan",
    "az" => "azərbaycan",
    "ban" => "Balinese",
    "su" => "Basa Sunda",
    "xx-bork" => "Bork, bork, bork!",
    "bs" => "bosanski",
    "br" => "brezhoneg",
    "ca" => "català",
    "ceb" => "Cebuano",
    "cs" => "čeština",
    "sn" => "chiShona",
    "co" => "Corsican",
    "ht" => "créole haïtien",
    "cy" => "Cymraeg",
    "da" => "dansk",
    "yo" => "Èdè Yorùbá",
    "et" => "eesti",
    "xx-elmer" => "Elmer Fudd",
    "eo" => "esperanto",
    "eu" => "euskara",
    "ee" => "Eʋegbe",
    "tl" => "Filipino",
    "fil" => "Filipino",
    "fo" => "føroyskt",
    "fy" => "Frysk",
    "gaa" => "Ga",
    "ga" => "Gaeilge",
    "gd" => "Gàidhlig",
    "gl" => "galego",
    "gn" => "Guarani",
    "xx-hacker" => "Hacker",
    "ha" => "Hausa",
    "haw" => "ʻŌlelo Hawaiʻi",
    "bem" => "Ichibemba",
    "ig" => "Igbo",
    "rn" => "Ikirundi",
    "id" => "Indonesia",
    "ia" => "interlingua",
    "xh" => "IsiXhosa",
    "zu" => "isiZulu",
    "is" => "íslenska",
    "jw" => "Jawa",
    "rw" => "Kinyarwanda",
    "sw" => "Kiswahili",
    "tlh" => "Klingon",
    "kg" => "Kongo",
    "mfe" => "kreol morisien",
    "kri" => "Krio (Sierra Leone)",
    "la" => "Latin",
    "lv" => "latviešu",
    "to" => "lea fakatonga",
    "lt" => "lietuvių",
    "ln" => "lingála",
    "loz" => "Lozi",
    "lua" => "Luba-Lulua",
    "lg" => "Luganda",
    "hu" => "magyar",
    "mg" => "Malagasy",
    "mt" => "Malti",
    "mi" => "Māori",
    "ms" => "Melayu",
    "pcm" => "Nigerian Pidgin",
    "no" => "norsk",
    "nn" => "norsk nynorsk",
    "nso" => "Northern Sotho",
    "ny" => "Nyanja",
    "oc" => "Occitan",
    "om" => "Oromoo",
    "xx-pirate" => "Pirate",
    "ps" => "Pashto",
    "fa" => "پښتو",
    "fa-AF" => "پښتو",
    "pl-PL" => "polski (Polska)",
    "pt" => "português",
    "qu" => "Runasimi",
    "rm" => "rumantsch grischun",
    "sm" => "Samoan",
    "sg" => "Sango",
    "sc" => "sardu",
    "sr" => "српски",
    "sh" => "Srpskohrvatski",
    "st" => "Sesotho",
    "tn" => "Sesotho sa Leboa",
    "sq" => "shqip",
    "sd" => "Sindhi",
    "si" => "සිංහල",
    "sk" => "slovenčina",
    "sl" => "slovenščina",
    "so" => "Soomaaliga",
    "nr" => "Sesotho",
    "es-MX" => "español (México)",
    "es-AR" => "español (Argentina)",
    "es-CL" => "español (Chile)",
    "es-CO" => "español (Colombia)",
    "es-EC" => "español (Ecuador)",
    "es-PE" => "español (Perú)",
    "es-UY" => "español (Uruguay)",
    "es-VE" => "español (Venezuela)",
    "sv" => "svenska",
    "tg" => "тоҷикӣ",
    "ta" => "தமிழ்",
    "roa-tara" => "tarandíne",
    "th-TH" => "ไทย (ไทย)",
    "bo" => "བོད་ཡིག",
    "ti" => "ትግርኛ",
    "to" => "lea fakatonga",
    "tr-TR" => "Türkçe (Türkiye)",
    "tk" => "Türkmençe",
    "tw" => "Twi",
    "uk" => "українська",
    "ur" => "اردو",
    "ug" => "Uyƣurqə",
    "uz" => "zbek",
    "xog" => "Lusoga",
    "vi-VN" => "Tiếng Việt (Việt Nam)",
    "cy-GB" => "Cymraeg (y Deyrnas Unedig)",
    "xh-ZA" => "isiXhosa (uMzantsi Afrika)",
    "zu-ZA" => "isiZulu (iNingizimu Afrika)",
    "ee-GH" => "Eʋegbe (Ghana)",
    "ha-NG" => "Hausa (Nijeriya)",
    "ig-NG" => "Igbo (Nigeria)",
    "yo-NG" => "Èdè Yorùbá (Nigeria)",
    "sn-ZW" => "chiShona (Zimbabwe)",
    "nso-ZA" => "Northern Sotho (South Africa)",
    "st-ZA" => "Sesotho (South Africa)",
    "tn-ZA" => "Sesotho sa Leboa (Afrika Borwa)",
    "nqo-GN" => "N'Ko (Gine)",
);

$writingStyleOptions = array(
    "infor" => esc_attr("Informative"),
    "acade" => esc_attr("Academic"),
    "analy" => esc_attr("Analytical"),
    "anect" => esc_attr("Anecdotal"),
    "argum" => esc_attr("Argumentative"),
    "artic" => esc_attr("Articulate"),
    "biogr" => esc_attr("Biographical"),
    "blog" => esc_attr("Blog"),
    "casua" => esc_attr("Casual"),
    "collo" => esc_attr("Colloquial"),
    "compa" => esc_attr("Comparative"),
    "conci" => esc_attr("Concise"),
    "creat" => esc_attr("Creative"),
    "criti" => esc_attr("Critical"),
    "descr" => esc_attr("Descriptive"),
    "detai" => esc_attr("Detailed"),
    "dialo" => esc_attr("Dialogue"),
    "direct" => esc_attr("Direct"),
    "drama" => esc_attr("Dramatic"),
    "evalu" => esc_attr("Evaluative"),
    "emoti" => esc_attr("Emotional"),
    "expos" => esc_attr("Expository"),
    "ficti" => esc_attr("Fiction"),
    "histo" => esc_attr("Historical"),
    "journ" => esc_attr("Journalistic"),
    "lette" => esc_attr("Letter"),
    "lyric" => esc_attr("Lyrical"),
    "metaph" => esc_attr("Metaphorical"),
    "monol" => esc_attr("Monologue"),
    "narra" => esc_attr("Narrative"),
    "news" => esc_attr("News"),
    "objec" => esc_attr("Objective"),
    "pasto" => esc_attr("Pastoral"),
    "perso" => esc_attr("Personal"),
    "persu" => esc_attr("Persuasive"),
    "poeti" => esc_attr("Poetic"),
    "refle" => esc_attr("Reflective"),
    "rheto" => esc_attr("Rhetorical"),
    "satir" => esc_attr("Satirical"),
    "senso" => esc_attr("Sensory"),
    "simpl" => esc_attr("Simple"),
    "techn" => esc_attr("Technical"),
    "theore" => esc_attr("Theoretical"),
    "vivid" => esc_attr("Vivid"),
    "busin" => esc_attr("Business"),
    "repor" => esc_attr("Report"),
    "resea" => esc_attr("Research")
);

$writingToneOptions = array(
    "formal" => esc_attr("Formal"),
    "asser" => esc_attr("Assertive"),
    "authoritative" => esc_attr("Authoritative"),
    "cheer" => esc_attr("Cheerful"),
    "confident" => esc_attr("Confident"),
    "conve" => esc_attr("Conversational"),
    "factual" => esc_attr("Factual"),
    "friendly" => esc_attr("Friendly"),
    "humor" => esc_attr("Humorous"),
    "informal" => esc_attr("Informal"),
    "inspi" => esc_attr("Inspirational"),
    "neutr" => esc_attr("Neutral"),
    "nostalgic" => esc_attr("Nostalgic"),
    "polite" => esc_attr("Polite"),
    "profe" => esc_attr("Professional"),
    "romantic" => esc_attr("Romantic"),
    "sarca" => esc_attr("Sarcastic"),
    "scien" => esc_attr("Scientific"),
    "sensit" => esc_attr("Sensitive"),
    "serious" => esc_attr("Serious"),
    "sincere" => esc_attr("Sincere"),
    "skept" => esc_attr("Skeptical"),
    "suspenseful" => esc_attr("Suspenseful"),
    "sympathetic" => esc_attr("Sympathetic"),
    "curio" => esc_attr("Curious"),
    "disap" => esc_attr("Disappointed"),
    "encou" => esc_attr("Encouraging"),
    "optim" => esc_attr("Optimistic"),
    "surpr" => esc_attr("Surprised"),
    "worry" => esc_attr("Worried")
);
