@extends('layouts.main')

@section('css')
    <style type="text/css">
        .landing {
            background-color: white;
            padding-left: 20px;
            padding-right: 20px;
        }

        .landing input {
            border: 1px solid black;
        }

        .landing select {
            border: 1px solid black;
        }

        .content h2 {
            font-size: 30px;
            margin-top: 35px;
        }

        .btn-image-url {
            display: inline-block;
            text-align: center;
            vertical-align: middle;
            padding: 12px 24px;
            border: 0px solid #7e1371;
            border-radius: 8px;
            background: #ed23d5;
            background: -webkit-gradient(linear, left top, left bottom, from(#ed23d5), to(#7e1371));
            background: -moz-linear-gradient(top, #ed23d5, #7e1371);
            background: linear-gradient(to bottom, #ed23d5, #7e1371);
            text-shadow: #4a0b43 1px 1px 1px;
            font: normal normal bold 20px tahoma;
            color: #ffffff !important;
            text-decoration: none;
        }
        .btn-image-url:hover,
        .btn-image-url:focus {
            border: 0px solid #941685;
            background: #ff2aff;
            background: -webkit-gradient(linear, left top, left bottom, from(#ff2aff), to(#971788));
            background: -moz-linear-gradient(top, #ff2aff, #971788);
            background: linear-gradient(to bottom, #ff2aff, #971788);
            color: #ffffff !important;
            text-decoration: none;
        }
        .btn-image-url:active {
            background: #7e1371;
            background: -webkit-gradient(linear, left top, left bottom, from(#7e1371), to(#7e1371));
            background: -moz-linear-gradient(top, #7e1371, #7e1371);
            background: linear-gradient(to bottom, #7e1371, #7e1371);
        }
        .btn-image-url:before{
            content:  "\0000a0";
            display: inline-block;
            height: 24px;
            width: 24px;
            line-height: 24px;
            margin: 0 4px -6px -4px;
            position: relative;
            top: 0px;
            left: 0px;
            background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAD5ElEQVRIiZWW34sVdRjGP8+c02nVzs6MPwoWnFlnRQ1EoosEL4yobsqiUKM2E0pKEBaJrsI/oCuDwBtBMCGhki6sKCvtBxRFkIQt1srZyZmzFyba2RHRxXTeLmZmd9xsV9+rOWee9/287/N+z8wRtYiCcCHiNYwdwFoQAgybAN4X7B1Pk3PcQahWfBXwkaS1AAbIinum4tqwC4KXxtPk2B0BoiAcAH6UFBSVy7u3ujabMrQ1Ts9+eluAFWGIjKOSnq6+NLMJwX6D08AA8LLQgzMwmzLYHKfJZ/MCoiB8QOIXTA4CM/sZeDJOkwuVaCgImwbvCHaBKHVTwLPxPHY5wCaQU3Z+HdhRLw4wnibXHctHgH3l1pHUBxyJgnDDfID7i1kA6MRpMjpbNLg8bHW63bxp+Qhm+4qFgKR7EEeiMLx3LkALo8q5PFsQBeErjvRbFA6uGut2keW7gX1W5ZgGMN6cCzAxc1hZEwXB4lrxZ4D9EquAr6JgcGWn281zeB3s63IdANujYLAZBWEwG9DwXa8h6UUESC2g3d92jy3xvAZwVNLSQmou4PSy7PPJLMt91/9bYhiBpAVgR4Dtvust6WXZ6foEx83sD6z6YWlXw9Ea4CFg5bR9xtvKnd0zveUdDCqrJDygBxweCsIt04A4Ta4BI4ZdL+a1KwYp8IKqI4mlwJ7xiT/zGYCCaYsElnMe6JPUMjgcBeGmagLiNDkOvGpmuWDSwa4g1tV2832cJlPVh6EwdIARquJmaVPWAVYDSGohDkVBOOBUSXGavAvsLCZ2HIxmZYFqpKEwXGjGXmCTVRbBe2fSNAfOm1lpmxYj3pgGAJg5B4A9YP2ITtENGLYxCgb7Co0GQcOSUGHplOBQUYA9wElV1hnPN+qAyUuT9LLs12UL7ruaN240JT1XjtwP1tffdk+c7Sbnfdf7EtgMdjewM06TEwC9S9kN3/Vakp4oT1f7JkAVFy9fxHe9DmIzpmVFp9rgiMaidvubpJv+5XveceCLOE0+qOf6rhdA0RjALQEAvSy74bveSWBY0l3FFrSxITmL2u1vk256rpdlY7PzfNfbIumRoif7f0AJmfBdb1SwFckpJ3m4ITX72+532aXM6vooDJcCByS1y4fi6JyAEjLmu9644ClDpV4bHbHMd72fell2FWBFEK4TfAhaXUt/S7eo+Z9YvXw5/8jZJjiI1KzebmZ2WeKMGQuBlULN6kSb2Siw/rYAVURBuA1xUKg5l87MUuDxOE3OzGtRPXpZdsp3vR8E643qIXhT6Rz4hOJNdxZq/yruJKIgbAGPAY8KBSa7hvE78DGWn4q73WntvyxRif6WAbnrAAAAAElFTkSuQmCC") no-repeat left center transparent;
            background-size: 100% 100%;
        }

        .btn-paragraph {
            display: inline-block;
            text-align: center;
            vertical-align: middle;
            padding: 12px 24px;
            border: 0px solid #127632;
            border-radius: 8px;
            background: #1dc051;
            background: -webkit-gradient(linear, left top, left bottom, from(#1dc051), to(#127632));
            background: -moz-linear-gradient(top, #1dc051, #127632);
            background: linear-gradient(to bottom, #1dc051, #127632);
            text-shadow: #0b4a1f 1px 1px 1px;
            font: normal normal bold 20px tahoma;
            color: #ffffff !important;
            text-decoration: none;
        }
        .btn-paragraph:hover,
        .btn-paragraph:focus {
            border: 0px solid #16943e;
            background: #23e661;
            background: -webkit-gradient(linear, left top, left bottom, from(#23e661), to(#168e3c));
            background: -moz-linear-gradient(top, #23e661, #168e3c);
            background: linear-gradient(to bottom, #23e661, #168e3c);
            color: #ffffff !important;
            text-decoration: none;
        }
        .btn-paragraph:active {
            background: #127632;
            background: -webkit-gradient(linear, left top, left bottom, from(#127632), to(#127632));
            background: -moz-linear-gradient(top, #127632, #127632);
            background: linear-gradient(to bottom, #127632, #127632);
        }
        .btn-paragraph:before{
            content:  "\0000a0";
            display: inline-block;
            height: 24px;
            width: 24px;
            line-height: 24px;
            margin: 0 4px -6px -4px;
            position: relative;
            top: 0px;
            left: 0px;
            background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAA3ElEQVRIie2WPQ6CQBCFPwgxBiy9hJ3xAp7Ak2tPYUWsiLE1VGDhkAzLsD9WFrxksrsw897syxaTMccWyI3vFnqg8yVkBvld1l4J6b0m74ELcItsiBJ4AnvZh2KQ/FOKQCvreLZixCDxAo6pAiXQyFlHo0QGFW2MSOoNro7IA9howtjXYjVSAmeg4vtYKiEvdGIxK52S1E7HFt7AYemnT8BbaOSajfxqUTRWi4KIsWgb4OhYLQpwrBb9uUWWQL6U7EEJ7DAsdwXGKaGWfQpyqZ3UuVMFpI0tLmZjzAcBIj2wpB3ppQAAAABJRU5ErkJggg==") no-repeat left center transparent;
            background-size: 100% 100%;
        }

        .btn-image-upload {
            display: inline-block;
            text-align: center;
            vertical-align: middle;
            padding: 12px 24px;
            border: 0px solid #a7598c;
            border-radius: 8px;
            background: #ff90e4;
            background: -webkit-gradient(linear, left top, left bottom, from(#ff90e4), to(#a7598c));
            background: -moz-linear-gradient(top, #ff90e4, #a7598c);
            background: linear-gradient(to bottom, #ff90e4, #a7598c);
            text-shadow: #693858 1px 1px 1px;
            font: normal normal bold 20px tahoma;
            color: #ffffff !important;
            text-decoration: none;
        }
        .btn-image-upload:hover,
        .btn-image-upload:focus {
            border: 0px solid #d16faf;
            background: #ffadff;
            background: -webkit-gradient(linear, left top, left bottom, from(#ffadff), to(#c86ba8));
            background: -moz-linear-gradient(top, #ffadff, #c86ba8);
            background: linear-gradient(to bottom, #ffadff, #c86ba8);
            color: #ffffff !important;
            text-decoration: none;
        }
        .btn-image-upload:active {
            background: #a7598c;
            background: -webkit-gradient(linear, left top, left bottom, from(#a7598c), to(#a7598c));
            background: -moz-linear-gradient(top, #a7598c, #a7598c);
            background: linear-gradient(to bottom, #a7598c, #a7598c);
        }
        .btn-image-upload:before{
            content:  "\0000a0";
            display: inline-block;
            height: 24px;
            width: 24px;
            line-height: 24px;
            margin: 0 4px -6px -4px;
            position: relative;
            top: 0px;
            left: 0px;
            background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAA1UlEQVRIid3UQYrCMBTG8R/iapZewIXeafaCc4LiJQZv4CG8lQOuXNhBRceFLcbSaZvSCvpBKCTve//3kjQ006BhXCsl+O4LkuCMvz4giyxxOJZdQZIs4cm9g5OOOsm35Ywv7HDADL+xkLKgHxwxxyqYX+MTKTa4xFT9EQyYBgXkHYwKa0VPZfIt9tk3NJQB6jwPGgSG2kr+Ka7SVzyDsdse1ynNYmtVBDRJHhXb6xvzHoBhg5hU5E8VA7hgEoA6B7ROnOv1D/npt6jNexQF2PYN6LyDK4XyMwOGil8jAAAAAElFTkSuQmCC") no-repeat left center transparent;
            background-size: 100% 100%;
        }


        .btn-embed-youtube {
            display: inline-block;
            text-align: center;
            vertical-align: middle;
            padding: 12px 24px;
            border: 0px solid #d90000;
            border-radius: 8px;
            background: #ff0000;
            background: -webkit-gradient(linear, left top, left bottom, from(#ff0000), to(#d90000));
            background: -moz-linear-gradient(top, #ff0000, #d90000);
            background: linear-gradient(to bottom, #ff0000, #d90000);
            text-shadow: #800000 1px 1px 1px;
            font: normal normal bold 20px tahoma;
            color: #ffffff !important;
            text-decoration: none;
        }
        .btn-embed-youtube:hover,
        .btn-embed-youtube:focus {
            border: 0px solid #ff0000;
            background: #ff0000;
            background: -webkit-gradient(linear, left top, left bottom, from(#ff0000), to(#ff0000));
            background: -moz-linear-gradient(top, #ff0000, #ff0000);
            background: linear-gradient(to bottom, #ff0000, #ff0000);
            color: #ffffff !important;
            text-decoration: none;
        }
        .btn-embed-youtube:active {
            background: #d90000;
            background: -webkit-gradient(linear, left top, left bottom, from(#d90000), to(#d90000));
            background: -moz-linear-gradient(top, #d90000, #d90000);
            background: linear-gradient(to bottom, #d90000, #d90000);
        }
        .btn-embed-youtube:before{
            content:  "\0000a0";
            display: inline-block;
            height: 24px;
            width: 24px;
            line-height: 24px;
            margin: 0 4px -6px -4px;
            position: relative;
            top: 0px;
            left: 0px;
            background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAEd0lEQVRIibWUS2hUVxjHf/fOzXUyZiDGiUlg4juJUG9jBIkPUEECSUpaHyshK3HvLouKIBSyc5duFLqKGDeCEUQCEhe6iUIMM5hFMLUWWslrkjEzk7nn8XUxD4yP2oX9w8c58J3v//8e5xznt8OHv481N/9it2zpBXy+DUK3WHyUf/fuGmP9/feXp6bEhKEYY6pmra2uH++/ZiYMZWVqSsb6+++7xvd740GAAYwxrK6uMjw8zPz8PJlMhuHhYdLpNMYYtNb/yQxQFwQY3+91RcTXIlWn53nMzs5y69YtpqenGRsbo66uDqUUhUKBfD6PUgqtNblcjmKxSD6fZ2NjY7OQCCLieyKCUmpTAwcHB7l69SrFYpEgCGhoaCCdTjM+Pg7AuXPn2L9/PyMjI5w5c4aZmRkaGxvp6ekBQERwHAcrgmtFCMMQpRRKKcIwJAgC1tbWGB0dpbu7m2w2y+joKJlMhvX1de7cucP6+jq3b99mbm6Ohw8f8uzZsyqH1hqlFGItrlhLGIYUi8Wqua5LX18fbW1tHD16lJWVFebn5zl27BidnZ2kUikWFxdxXRelFMYYrLWbOIrFIlYEz5YFPsaOHTtoamoiGo0ShiHGmGqllYQAtNaISNX/IcRaPjsDyjeqEiQi+L6PMQaAWCy2qdcigrX2Ex4RwavMoHK4gkgkQjQaRSlFbW0te/fu5d69e8RiMQ4ePEg0GsX3fR4/fszS0hLt7e2fVGCtxZPPKAN0dXWxZ88eampqcByHgYEBWltbcRyHrq4uRIShoSFWV1fp6emhvr7+sxU4Ix0dsq+z8xOBb4HXMzN4W3M5vkul/heBd7kcngBWBOM4xAYGqIlGAQiXl8lOThIV2RSUTyapTyQIUykoD/1LECgJaCAUYcvZs2zr6EBE2Hj6lPUnT/Cs3RSUOXCAlkOHKLx6hWj9VYHIT/H49VbfxwXyk5OoXbtYePkSff06biKBGwTIygomCLC5HLmdO9ne3k42DNF1ddiFBXQshhw/jkomMe/f4+TzCPA2DHErLbIiaGurr9KKYIKAbVeu4DY2Er98GZJJEEE3N+N2d5MYGmItHsc9f576wUESFy+iLlzAAkYEgZKAEcGURQBwHIwIiOC6bunTchwEsABzc2Rv3oStW5GmJhInT/LmwQP+mpggfuIEqpy0AB5lAcrBUjYrUiIrr/JBkGstrjEYa7Geh0QitF26hKyt8X5pCeO61fl4QulBUP5epUxaETLWloispXLWWosYU/omtCbiOKRv3EDPzqKTSRq1LnGJ4CGC+TjTcotcx0FiMZxTp3BbWkp+x0H27SPS14dnLXp5mezbt2w/fRrnyBGKnoe8eEHlckd+iMd/bvK8SOVqOcagXr/G/vEHhYUFrDHkMxk2nj/HzM1hczn8QgE/kWBxYgLSaQrT09Tu3o2rNfm7dyGbxQB/ax06v7a03N9dU/NjQySCWx7wV1Fu6Zf2VoQVY3ij1LgXwrXfleJPrXsd8OXLtKUKy238tz0QapFHCq79A7a+TD7kQoVWAAAAAElFTkSuQmCC") no-repeat left center transparent;
            background-size: 100% 100%;
        }

        .btn-embed-html {
            display: inline-block;
            text-align: center;
            vertical-align: middle;
            padding: 12px 24px;
            border: 0px solid #b3b30d;
            border-radius: 8px;
            background: #ffff12;
            background: -webkit-gradient(linear, left top, left bottom, from(#ffff12), to(#b3b30d));
            background: -moz-linear-gradient(top, #ffff12, #b3b30d);
            background: linear-gradient(to bottom, #ffff12, #b3b30d);
            text-shadow: #ffff17 1px 1px 1px;
            font: normal normal bold 20px tahoma;
            color: #111111;
            text-decoration: none;
        }
        .btn-embed-html:hover,
        .btn-embed-html:focus {
            border: 0px solid #ffff12;
            background: #ffff16;
            background: -webkit-gradient(linear, left top, left bottom, from(#ffff16), to(#d7d710));
            background: -moz-linear-gradient(top, #ffff16, #d7d710);
            background: linear-gradient(to bottom, #ffff16, #d7d710);
            color: #111111;
            text-decoration: none;
        }
        .btn-embed-html:active {
            background: #b3b30d;
            background: -webkit-gradient(linear, left top, left bottom, from(#b3b30d), to(#b3b30d));
            background: -moz-linear-gradient(top, #b3b30d, #b3b30d);
            background: linear-gradient(to bottom, #b3b30d, #b3b30d);
        }
        .btn-embed-html:before{
            content:  "\0000a0";
            display: inline-block;
            height: 24px;
            width: 24px;
            line-height: 24px;
            margin: 0 4px -6px -4px;
            position: relative;
            top: 0px;
            left: 0px;
            background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAFk0lEQVRIiY2VW2xcRxnHf3PO2fXuerdb2+t7QmynudRpmqYhVAlORQkqbRostVQgKOKSB6qqjWgBkQcERZV4KOKBIt4QSEEVUosoEqnSpsJVU5HUIIghdpzKNKmz8WW93uyu93J298ycGR72rDF9MIz01xnNme/7Sd9tBP979QGfBvYBPcFZEbgCvA1c38xYbPLvXjsc/sHIoUPHdhw9Gk6NjlLwMtz0JmlUa9RmFDf/eU77l+p/ps6LwNn/FxAGftzzmeFnT3z/V069t8SyO0dHZITe9v0srX1IKNrHYm6O6YXfMP/hWSLnt2n33LXX0PpJIL8ZIC5i1u8ePPXkQ498/SSLq1cphm7w3sorrLjzfHPP77FFF57VRlkpstUsBVXkavoVxPUu0i+8NEvZPAykWw7tDc4tK2r99v6ffP5zjz7+bdYqaVS1TF2scXzwGXCgKzJAd3QbAEYIbCeK7STBiVOwZil1XO7mijmK5GXA+yjgqYPPHfuuO7ZMxLFJV6boSiW4TSToEB0c2fIonW0DGEAbgw/4xqCMwQ73EE3ewy3v73jRbC/Tpgc4sxGQGhjd+Vry2US0ZJZJe9OokMu3hp7nbP40bxdf5WZ1lridoKOtD21AAtIYpDF4WiOxaPiSgnwXctY9ZM2bwKIVAE4ce+Zk56Hex7AsC8uyCDkOF9b+yEj7MDlvmaKXIWaHWGssELIsQkIQEgIHcITAFoJU/4PEbh+Fw7aFJZ4DsADinZ1fOvDZY2jkerxuySy/Xvw552+9BcBqYwnwGYgNYwuBHRhbQiCEwAIcp53hfT+ELo0YbDsOxC0gtW3//rvCsRh9bcP4vo/v+0gpUUqxUs+gtebu5H3sSd73XyVnAm1ckcQIOz75M+L798aBey1gpPuOOxxlDNn6Ir7vo5RqSip830f7msNdDyODpKogyTpIuDamuQcQgmT/IVIHxwF2OkDMjkbxtGbZncf3fYwxCNFsEa01Wht8QtR8n4bWzaQGWgcGoFZjWdEorRBp6fvUtaY/tg8lFVLKdeELtkVH6Y/dTUVrXK2pa03dGLxArWrSG2OlNYBygIX80hKu1mxNHKY/upeblSmEEOxIfoLxjz1N1E5yrXKdeHgLVa2pak3N96kFsEYgAGOaWfEyGYAlC1jIzMxkKlJS0YaxwZP0RfcgpeRA6jFSsX20hbeSa5R5f+0y07mLFL0KVa1xfZ+ar1hzl5DGUC+nyaffQghBdWZGA5eaIRPi9BfPnPnqlt27ido2lqnz8vQTJEJd7O48SrGxwsHBr2HZSSqqxtXsn7iWPc9i9i+gHKqFNO3td+GufkDPyBcY2HmC6fHxf6hi8UCrkzOelCf6H3hA+MZgsLmze5z2tgHKssSqe4N/5SfxjODC9V8w+cFL3MrPImtlZLUECmR5FTxNaug47vlZChMTzwN/awEWCnNzB7qOHNnlpFLNcsQmGh4gGbuT/o776U2OYewO6tJjYWkClAApgpnR3FvE6Bv+MukXXpzTrvsUoFqjAqPU0xdPncqu5nIUlKKgFPngW5CSou9TMWHylQx4AhqiOS/lf0B9u77C8k9/6clc7htAfeOwAyh5hcLk6tTU44mxsTYVidAwhprW1IKEuloTTuwlHNmGalTw3Qqm7oGEcGgQc66m1t698D3gD62+2wgASDcymXdWJiYesrdvv8309zdrXmsa67UuiMS3k9r6CLaIsXbjIiIfxjpnue7U+z+i+U53AxGg9FEAwIJfKp3Ovf761sqVK7tEPG473d2IUGj9ghACLSWFyQmqZy5r3vHe0/nqd4BLrStAFCht9ug7wMeBJ+xE4lORoaEhp6MjLoRAlctufX5+SeXzfwXeAGY32GnABbJAcTPAxhUBbgfiARiCJAYOVaB64Fy1DP8NBuPmdnZEYMAAAAAASUVORK5CYII=") no-repeat left center transparent;
            background-size: 100% 100%;
        }

        .btn-blockquote {
            display: inline-block;
            text-align: center;
            vertical-align: middle;
            padding: 12px 24px;
            border: 0px solid #0e9acc;
            border-radius: 8px;
            background: #17faff;
            background: -webkit-gradient(linear, left top, left bottom, from(#17faff), to(#0e9acc));
            background: -moz-linear-gradient(top, #17faff, #0e9acc);
            background: linear-gradient(to bottom, #17faff, #0e9acc);
            text-shadow: #096080 1px 1px 1px;
            font: normal normal bold 20px tahoma;
            color: #ffffff !important;
            text-decoration: none;
        }
        .btn-blockquote:hover,
        .btn-blockquote:focus {
            border: 0px solid #12c0ff;
            background: #1cffff;
            background: -webkit-gradient(linear, left top, left bottom, from(#1cffff), to(#11b9f5));
            background: -moz-linear-gradient(top, #1cffff, #11b9f5);
            background: linear-gradient(to bottom, #1cffff, #11b9f5);
            color: #ffffff !important;
            text-decoration: none;
        }
        .btn-blockquote:active {
            background: #0e9acc;
            background: -webkit-gradient(linear, left top, left bottom, from(#0e9acc), to(#0e9acc));
            background: -moz-linear-gradient(top, #0e9acc, #0e9acc);
            background: linear-gradient(to bottom, #0e9acc, #0e9acc);
        }
        .btn-blockquote:before{
            content:  "\0000a0";
            display: inline-block;
            height: 24px;
            width: 24px;
            line-height: 24px;
            margin: 0 4px -6px -4px;
            position: relative;
            top: 0px;
            left: 0px;
            background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAC1UlEQVRIiZWUQWgcZRiGn/dPDou0STaEHqTOmMlFBLWI9dCDRkStgiBCbQ+iKIiC9OK9h548FTwoQgt6EUXxYvVQJSQ3RRAMIqGU7nRnIqGKmE6IIaztvj3sJG42M9vtd/u/eZ/3f+f/Zz5RVhLFEXAWeAGYFrQNXwPvp3m2QUUlUXykZOaBBnAF8am6+rC12u4ACGAuih+0WBI6BGCD1DOxfRn0ZJq3/9pjHsfPYr6R1NirB/CC8IutPN8eS+6LxxGXJM31G+wAkmbAD00fnPlifWPdZfIZYFHSxKC+ZBLDgfWi+D4gjoOOVB1BH3Lc4eZ8X+NN0MxQQryTRFEUgGeGm++me72v9dydGFADdGocSO4sBuCJJJoNcKt7F8zTgd7tj1KHTXcCE4DxkQjxQAAqP8F9WmlcMN04eKAr2BxpA3MoACsjiXvVWFlZwRqZaQTg27vYoFMmG5XpBMQv4EsjyaXyaPQV+MoIxGZIs6wLesP48jCl7S13vQGQ5u0txAnbfw/NA9dDCVyXOWp8uhYSawps7yzTLPvN4hHjM8I3K0PB1bCzaOXZpuzz9a/Acu9t/69rWbaG+cwQaqjlPQ+MHu7NnspaqunPg+o2WBp88G6VynYHuDjYn4vjALxVaW2vyfpxd4Mkih8TerUmyUKaZ3/s9+CUpGOV/vB5a7XdCQCzUXwY+BLVjoBz+9JH9z8K+rg6vLcNHwGE2Sh+XOInSdUDzCykebbY30qi+GXwksREJQPnr+VZGyAE2ALurUmyaVx1L8Goxtw59pld4X/4d8wPFcIu8HaaZ/v+WOOL4KsVgbaAk+lqvjtAx4qioDk59SfSa+qzAN5L8+xCVcYbRXGrOdmUxPN99tvAK4PHGQAkFrGXyxT/ACfSPPug8gR2Sv7E9o3SvA08lebZd4OyMYD1onBzcupfetPypTTPfh5q3mM6zcmpe4BfwSfTPG9V6W4DnqApZniD3nEAAAAASUVORK5CYII=") no-repeat left center transparent;
            background-size: 100% 100%;
        }
    </style>
@endsection
@section('content')
    <div class="landing">

        <section class="content">
            <form action="{{ url('dashboard/post' . (!empty($post) ? '/' . $post->id : '')) }}" method="post"
                  enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <h1 class="section-heading">Add/Edit Post --- Click <a style="text-decoration: underline" href="{{url('dashboard/post/list')}}">here</a> to go back to the post list.</h1>

                <div class="field-set">
                    <label for="title">Title:</label>

                    <div class="field">
                        <input id="title" name="title" type="text" placeholder="Create your title here..."
                               value="{{$post->title or ''}}" required/>
                    </div>
                </div>
                <div class="field-set">
                    <label>Permalink:</label>

                    <div class="field">
                        <a href="{{!empty($post->slug) ? url($post->slug) : 'None yet'}}">
                            {{!empty($post->slug) ? url($post->slug) : 'None yet'}}
                        </a>
                    </div>
                </div>

                <div class="field-set">
                    <label for="description">Description (Facebook caption):</label>

                    <div class="field">
                        <input id="description" name="description" type="text" value="{{$post->description or ''}}"
                               placeholder="Enter description here..." class="form-control input-md" required=""/>
                    </div>
                </div>


                <div class="field-set">
                    <label for="category">Category:</label>
                    <select id="category" name="category_id" class="form-control" required>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" {{ !empty($post->category_id) && $post->category_id == $category->id ? ' selected' : '' }}>{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="field-set row">
                    <label>Status: </label>
                    <select id="status" name="status" class="form-control select">
                        <option value="1" data-bg="#A2FACB"
                                style="background-color: #A2FACB" {{ !empty($post) && $post->status == 1 ? 'selected' : '' }}>
                            Enabled
                        </option>
                        <option value="0" data-bg="#f7e1b5"
                                style="background-color: #f7e1b5" {{ !empty($post) && $post->status == 0 ? 'selected' : '' }}>
                            Pending
                        </option>
                        <option value="2" data-bg="#F799B1"
                                style="background-color: #F799B1" {{ !empty($post) && $post->status == 2 ? 'selected' : '' }}>
                            Deleted
                        </option>
                    </select>
                </div>

                <div class="field-set">

                    @if(!empty($post->image))
                        <label>Current Thumbnail:</label>
                        <div class="field">
                            <a target="_blank" href="{{$post->image}}"> <img src="{{$post->image}}"
                                                                             style="border-radius:3px; border:1px solid black; width:312px; height:200px;"/>
                            </a>
                        </div>
                    @endif

                    <label for="image">No thumbnail yet, upload one below.</label>


                    <div class="field">
                        <input id="image" name="image" class="form-control" type="file">
                    </div>

                    <label for="image_url">Or enter the URL of an image to use as the thumbnail:</label>

                    <div class="field">
                        <input id="image_url" name="image_url" type="text"
                               placeholder="(Optional) Paste an image URL here..." class="form-control"
                               value="{{$post->image or ''}}">
                    </div>
                </div>
                <div class="field-set third" style="margin-top:5px">
                    <input id="serialpost" type="button" class="btn" value="Save Post"/>
                </div>


                <div id="blockcontentdiv">

                </div>
                <input id="submitpost" type="submit" class="btn" style="display:none"/>
            </form>
            <div class="field-set" style="width:100%;float:left">
                <h1 style="text-decoration: underline; padding-bottom:0">Content Blocks</h1>
                <button class="block-type btn-paragraph" data-block-type="paragraph">Paragraph or Big Text</button>
                <button class="block-type btn-blockquote" data-block-type="blockquote">Block Quote</button>
                <button class="block-type btn-image-url" data-block-type="image-url">Image (Paste URL)</button>
                <button class="block-type btn-image-upload" data-block-type="image-upload">Image (Upload)</button>
                <br />
                <br />
                <button class="block-type btn-embed-youtube" data-block-type="youtube">YouTube Link</button>
                <button class="block-type btn-embed-html" data-block-type="html">Embeds (IG/Twitter)</button>
                <br />
                <p style="padding: 10px 10px 0px 10px; margin: 0" id="block-type-message" data-block-type=""></p>
                <br />
                <div class="field" style="width:100%;float:left">

                    <div style="width:100%;padding-left:10px;padding-right:10px;">
                        <div style="width:100%;padding-left:10px;padding-right:10px;margin-bottom:20px" id="blockcontentdiv">
                            <textarea id="textcontent" name="textcontent" style="height:100px"></textarea>
                            <input id="mediacontent" type="text" name="mediacontent" style="display:none">

                            <form id="imageuploadform" action="{{ url('dashboard/post/uploadimage') }}" method="post">
                                <input id="imagecontent" type="file" name="imagecontent" style="display:none">
                            </form>
                            <div id="imagesource" style="display:none">
                                <textarea id="imagesourcecontent" name="imagesourcecontent"
                                          style="height:20px;display:none"></textarea>
                            </div>
                        </div>
                        <div style="width: 200px; padding-left:10px;padding-right:10px;text-align:center">
                            <input type="button" class="btn" value="Add Block" onclick="addBlock()">
                        </div>
                    </div>
                </div>
            </div>

            <div id="preview" class="field-set">
                <ul id="sortable">
                    @if($post != null)
                        @for($bcount = 0; $bcount < count($post->blocks); $bcount++)
                            <li id="sortableli{{$bcount}}" class="ui-state-default"
                                style="background-color:white;background-image:none">
                                <span style="float: left;margin-top: 10px; padding-right: 20px; cursor: pointer;">+</span>

                                <div style="padding-top:10px;float:left;width:93%">
                                    <div id="contentdiv{{$bcount}}" contenteditable="true" name="contentdiv[]"
                                         style="width:80%;float:left">
                                        {!! $post->blocks[$bcount] !!}
                                    </div>
                                    <div style="width:20%;float:left">
                                        <a onclick="removeBlock({{$bcount}})" style="float:right;cursor:pointer">x</a>
                                    </div>
                                </div>
                            </li>
                        @endfor
                    @endif
                </ul>
            </div>

            <br /><br />
            <div class="field-set third" style="margin-top:20px">
                <input id="serialpost" type="button" class="btn" value="Save Post"/>
            </div>

        </section>

    </div>

@endsection

@section('js-bottom')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="{{ asset('assets/admin/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/ckeditor/adapters/jquery.js') }}"></script>
    <script src="//malsup.github.com/jquery.form.js"></script>
    <style>
        #sortable {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        #sortable li {
            margin: 0 3px 3px 3px;
            padding: 0.4em;
            padding-left: 1.5em;
            width: 100%;
            float: left;
            list-style: none
        }

        strong {
            font-weight: bold
        }
    </style>
    <script>
        var blockindex = {{$bcount or 0}};

        function removeBlock(id) {
            $('#sortableli' + id).detach();
        }

        function addBlock() {
            var blocktype = $('#block-type-message').data('block-type');
            alert(blocktype);
            var block = null;
            if (blocktype == 'paragraph') {
                block = $($('#textcontent').val());
            } else if (blocktype == 'blockquote') {
                block = $('<blockquote cite="">' + $('#textcontent').val().replace('<p>', '').replace('</p>', '') + '</blockquote>')
            } else if (blocktype == 'youtube') {
                var mc = $('#mediacontent').val().replace('watch', 'embed');
                block = $('<iframe width="640" height="360" src="' + mc + '" frameborder="0" allowfullscreen></iframe>');
            } else if (blocktype == 'html') {
                    block = $($('#mediacontent').val());
            } else if (blocktype == 'image-url') {
                var imgsrc = $('#imagesourcecontent').val().replace('<p>', '').replace('</p>', '');
                if (imgsrc.indexOf('</a>') == -1) {
                    imgsrc = '<a href="' + imgsrc + '">' + imgsrc + '</a>';
                }
                block = $('<img src="' + $('#mediacontent').val() + '" alt="" style="width:100%"><span class="source"><span>via:</span>' + imgsrc + '</span>');
            } else if (blocktype == 'image-upload') {
                var imgsrc = $('#imagesourcecontent').val().replace('<p>', '').replace('</p>', '');
                if (imgsrc.indexOf('</a>') == -1) {
                    imgsrc = '<a href="' + imgsrc + '">' + imgsrc + '</a>';
                }
                block = $('<img id="upimage' + blockindex + '" src="" alt="" style="width:100%""><span class="source"><span>via:</span>' + imgsrc + '</span>');
                var tmp_blockindex = blockindex;
                $('#imageuploadform').ajaxForm({
                    dataType: 'json',
                    reference: null,
                    beforeSend: function () {
                    },
                    error: function () {
                        alert("An error occurred while uploading your image");
                    },
                    success: function (data) {
                        if (data.success) {
                            $('#upimage' + tmp_blockindex).attr('src', data.url);
                        } else {
                            alert('An error occurred.');
                            this.error();
                        }
                    }
                });
                $('#imageuploadform').submit();
            }
            var blockdiv = $('<div style="padding-top:10px;float:left;width:93%"></div>');
            var contentdiv = $('<div id="contentdiv' + blockindex + '" contenteditable="true" name="contentdiv[]" style="width:80%;float:left"></div>');
            contentdiv.append(block);
            var closediv = $('<div style="width:20%;float:left"></div>');
            var closebutton = $('<a onclick="removeBlock(' + blockindex + ')" style="float:right;cursor:pointer">x</a>');
            closediv.append(closebutton);
            blockdiv.append(contentdiv);
            blockdiv.append(closediv);
            var sortableli = $('<li id="sortableli' + blockindex + '" class="ui-state-default" style="background-color:white;background-image:none"><span style="float: left;margin-top: 10px; padding-right: 20px; cursor: pointer;">+</span></li>');
            sortableli.append(blockdiv);
            $('#sortable').append(sortableli);
            if (blocktype == 'paragraph') {
                CKEDITOR.inline('contentdiv' + blockindex, {
                    toolbar: [
                        {name: 'basicstyles', groups: ['basicstyles', 'cleanup'], items: ['Bold']},
                        {name: 'links', items: ['Link']},
                        {name: 'styles', items: ['Format']}
                    ],
                    startupFocus: false
                });
            }
            blockindex++;

            $('#cke_textcontent').val("");
            $('#textcontent').val("");
            $('#imagecontent').val("");
            $('#mediacontent').val("");
            $('#imagesource').val("");
        }

        $(document).ready(function () {
            $('#status').change(function () {
                $(this).siblings('.sd-select').find('.sd-label').css('background-color', $('option:selected', this).attr('data-bg'));
            });

            $("#status > option").each(function (i) {
                $('#status').siblings('.sd-select').find('.sd-options > li').eq(i).css('background-color', $(this).attr('data-bg'));
            });

            $('#status').siblings('.sd-select').find('.sd-label').css('background-color', $('option:selected', $('#status')).attr('data-bg'));

            $('.block-type').click(function (e) {
                e.preventDefault();
                $('#block-type-message').text('You are currently creating a block for: "' + $(this).text() + '"');
                $('#block-type-message').data('block-type', $(this).data('block-type'));

                $('#cke_textcontent').hide();
                $('#imagecontent').hide();
                $('#mediacontent').hide();
                $('#imagesource').hide();

                if ($(this).data('block-type') == 'image-upload') {
                    $('#cke_textcontent').hide();
                    $('#imagecontent').show();
                    $('#mediacontent').hide();
                    $('#imagesource').show();
                } else if ($(this).data('block-type') == 'image-url') {
                    $('#cke_textcontent').hide();
                    $('#imagecontent').hide();
                    $('#mediacontent').show();
                    $('#imagesource').show();
                } else if ($(this).data('block-type') == 'youtube') {
                    $('#cke_textcontent').hide();
                    $('#imagecontent').hide();
                    $('#mediacontent').show();
                    $('#imagesource').hide();
                }
                else if ($(this).data('block-type') == 'html') {
                    $('#cke_textcontent').hide();
                    $('#imagecontent').hide();
                    $('#mediacontent').show();
                    $('#imagesource').hide();
                } else {
                    $('#cke_textcontent').show();
                    $('#imagecontent').hide();
                    $('#mediacontent').hide();
                    $('#imagesource').hide();
                }
            });

            $('#serialpost').click(function () {
                $('div[name^="contentdiv"]').each(function () {
                    var blockdata = $(this).html();
                    var pblock = $('<input type="hidden" name="blocks[]" value="">');
                    pblock.val(blockdata);
                    $('#blockcontentdiv').append(pblock);
                });
                $('#submitpost').click();
            });

            $("#sortable").sortable({
                connectWith: 'ul',
                handle: 'span'
            });

            var myToolbar = [
                ['Bold', 'Italic', 'Link', 'Format']
            ];

            var config = {
                toolbar_mySimpleToolbar: myToolbar,
                toolbar: 'mySimpleToolbar'
            };

            $('#textcontent').ckeditor(config);

            myToolbar = [
                ['Link']
            ];

            config = {
                toolbar_mySimpleToolbar: myToolbar,
                toolbar: 'mySimpleToolbar'
            };

            $('#imagesourcecontent').ckeditor(config);

            if (blockindex > 0) {
                for (i = 0; i < blockindex; i++) {
                    if ($('#contentdiv' + i).find('p').html() != null) {
                        CKEDITOR.inline('contentdiv' + i, {
                            toolbar: [
                                {name: 'basicstyles', groups: ['basicstyles', 'cleanup'], items: ['Bold']},
                                {name: 'links', items: ['Link']},
                                {name: 'styles', items: ['Format']}
                            ],
                            startupFocus: false
                        });
                    }
                }
            }
        });
    </script>
@endsection