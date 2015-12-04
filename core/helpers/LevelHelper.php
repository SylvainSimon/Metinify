<?php

class LevelHelper {

    public static function getAll($sort = true) {

        $arrLevel = array(
            1 => 300,
            2 => 800,
            3 => 1500,
            4 => 2500,
            5 => 4300,
            6 => 7200,
            7 => 11400,
            8 => 17000,
            9 => 24000,
            10 => 33000,
            11 => 46000,
            12 => 62000,
            13 => 83000,
            14 => 111000,
            15 => 149000,
            16 => 200000,
            17 => 268000,
            18 => 360000,
            19 => 482000,
            20 => 647000,
            21 => 868000,
            22 => 996000,
            23 => 1143000,
            24 => 1312000,
            25 => 1506000,
            26 => 1729000,
            27 => 1984000,
            28 => 2277000,
            29 => 2614000,
            30 => 3000000,
            31 => 3143000,
            32 => 3952000,
            33 => 4536000,
            34 => 5206000,
            35 => 5975000,
            36 => 6858000,
            37 => 7730000,
            38 => 8504000,
            39 => 9307000,
            40 => 10140000,
            41 => 11330000,
            42 => 12320000,
            43 => 13370000,
            44 => 14490000,
            45 => 15670000,
            46 => 16920000,
            47 => 18240000,
            48 => 19630000,
            49 => 21090000,
            50 => 22630000,
            51 => 24670000,
            52 => 26890000,
            53 => 29310000,
            54 => 31950000,
            55 => 34820000,
            56 => 37960000,
            57 => 41370000,
            58 => 45100000,
            59 => 49160000,
            60 => 53580000,
            61 => 58400000,
            62 => 63660000,
            63 => 69390000,
            64 => 75630000,
            65 => 82440000,
            66 => 89860000,
            67 => 97950000,
            68 => 106760000,
            69 => 136370000,
            70 => 151800000,
            71 => 168300000,
            72 => 250000000,
            73 => 340000000,
            74 => 350000000,
            75 => 350000000,
            76 => 370000000,
            77 => 380000000,
            78 => 390000000,
            79 => 420000000,
            80 => 450000000,
            81 => 480000000,
            82 => 530000000,
            83 => 580000000,
            84 => 600000000,
            85 => 690000000,
            86 => 780000000,
            87 => 810000000,
            88 => 900000000,
            89 => 930000000,
            90 => 1000000000,
            91 => 1000000000,
            92 => 1100000000,
            93 => 1100000000,
            94 => 1100000000,
            95 => 1100000000,
            96 => 1100000000,
            97 => 1200000000,
            98 => 1200000000,
            99 => 1200000000,
            100 => 1200000000,
            101 => 1200000000,
            102 => 1300000000,
            103 => 1300000000,
            104 => 1300000000,
            105 => 1300000000,
            106 => 1300000000,
            107 => 1400000000,
            108 => 1400000000,
            109 => 1400000000,
            110 => 1400000000,
            111 => 1400000000,
            112 => 1500000000,
            113 => 1500000000,
            114 => 1500000000,
            115 => 1500000000,
            116 => 1500000000,
            117 => 1500000000,
            118 => 1500000000,
            119 => 1500000000,
            120 => 1500000000,
            121 => 1500000000,
            122 => 1500000000,
            123 => 1500000000,
            124 => 1500000000,
            125 => 1500000000,
            126 => 1500000000,
            127 => 1500000000,
            128 => 1500000000,
            129 => 1500000000,
            130 => 1500000000,
            131 => 1500000000,
            132 => 1500000000,
            133 => 1500000000,
            134 => 1500000000,
            135 => 1500000000,
            136 => 1500000000,
            137 => 1500000000,
            138 => 1500000000,
            139 => 1500000000,
            140 => 1500000000,
            141 => 1500000000,
            142 => 1500000000,
            143 => 1500000000,
            144 => 1500000000,
            145 => 1500000000,
            146 => 1500000000,
            147 => 1500000000,
            148 => 1500000000,
            149 => 1500000000,
            150 => 1500000000,
            151 => 1500000000,
            152 => 1500000000,
            153 => 1500000000,
            154 => 1500000000,
            155 => 1500000000,
            156 => 1500000000,
            157 => 1500000000,
            158 => 1500000000,
            159 => 1500000000,
            160 => 1500000000,
            161 => 1500000000,
            162 => 1500000000,
            163 => 1500000000,
            164 => 1500000000,
            165 => 1500000000,
            166 => 1500000000,
            167 => 1500000000,
            168 => 1500000000,
            169 => 1500000000,
            170 => 1500000000,
            171 => 1500000000,
            172 => 1500000000,
            173 => 1500000000,
            174 => 1500000000,
            175 => 1500000000,
            176 => 1500000000,
            177 => 1500000000,
            178 => 1500000000,
            179 => 1500000000,
            180 => 1500000000,
            181 => 1500000000,
            182 => 1500000000,
            183 => 1500000000,
            184 => 1500000000,
            185 => 1500000000,
            186 => 1500000000,
            187 => 1500000000,
            188 => 1500000000,
            189 => 1500000000,
            190 => 1500000000,
            191 => 1500000000,
            192 => 1500000000,
            193 => 1500000000,
            194 => 1500000000,
            195 => 1500000000,
            196 => 1500000000,
            197 => 1500000000,
            198 => 1500000000,
            199 => 1500000000,
            201 => 1500000000,
            202 => 1500000000,
            203 => 1500000000,
            204 => 1500000000,
            205 => 1500000000,
            206 => 1500000000,
            207 => 1500000000,
            208 => 1500000000,
            209 => 1500000000,
            210 => 1500000000,
            211 => 1500000000,
            212 => 1500000000,
            213 => 1500000000,
            214 => 1500000000,
            215 => 1500000000,
            216 => 1500000000,
            217 => 1500000000,
            218 => 1500000000,
            219 => 1500000000,
            220 => 1500000000,
            221 => 1500000000,
            222 => 1500000000,
            223 => 1500000000,
            224 => 1500000000,
            225 => 1500000000,
            226 => 1500000000,
            227 => 1500000000,
            228 => 1500000000,
            229 => 1500000000,
            230 => 1500000000,
            231 => 1500000000,
            232 => 1500000000,
            233 => 1500000000,
            234 => 1500000000,
            235 => 1500000000,
            236 => 1500000000,
            237 => 1500000000,
            238 => 1500000000,
            239 => 1500000000,
            240 => 1500000000,
            241 => 1500000000,
            242 => 1500000000,
            243 => 1500000000,
            244 => 1500000000,
            245 => 1500000000,
            246 => 1500000000,
            247 => 1500000000,
            248 => 1500000000,
            249 => 1500000000,
            250 => 1500000000,
            251 => 1500000000,
            252 => 1500000000,
            253 => 1500000000,
            254 => 1500000000,
            255 => 1500000000,
            256 => 1500000000,
            257 => 1500000000,
            258 => 1500000000,
            259 => 1500000000,
            260 => 1500000000,
            261 => 1500000000,
            262 => 1500000000,
            263 => 1500000000,
            264 => 1500000000,
            265 => 1500000000,
            266 => 1500000000,
            267 => 1500000000,
            268 => 1500000000,
            269 => 1500000000,
            270 => 1500000000,
            271 => 1500000000,
            272 => 1500000000,
            273 => 1500000000,
            274 => 1500000000,
            275 => 1500000000,
            276 => 1500000000,
            277 => 1500000000,
            278 => 1500000000,
            279 => 1500000000,
            280 => 1500000000,
            281 => 1500000000,
            282 => 1500000000,
            283 => 1500000000,
            284 => 1500000000,
            285 => 1500000000,
            286 => 1500000000,
            287 => 1500000000,
            288 => 1500000000,
            289 => 1500000000,
            290 => 1500000000,
        );

        if ($sort) {
            asort($arrLevel);
        }

        return $arrLevel;
    }

    public static function getValue($level = 0) {

        $arrLevel = self::getAll();

        if (array_key_exists($level, $arrLevel)) {
            return $arrLevel[$level];
        } else {
            return "inconnu";
        }
    }

}
