@extends('jarboe::layouts.main')

@push('styles')
    <style>
        body {
            background: url("/vendor/jarboe/img/6-reversed.jpg") #fff !important;
            background-size: cover !important;
            min-height: 100vh;
        }
        div#content {
            overflow-x: hidden;
            overflow-y: hidden;
            height: 100vh;
        }
    </style>

    <style>
        .all-wrap *,
        .all-wrap *:before,
        .all-wrap *:after {
            box-sizing: border-box;
            position: relative;
            -webkit-animation-timing-function: cubic-bezier(0.5, 0, 0.5, 1);
            animation-timing-function: cubic-bezier(0.5, 0, 0.5, 1);
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
        }

        .all-wrap *:before,
        .all-wrap *:after {
            content: '';
            display: block;
        }

        .all-wrap {
            -webkit-animation: bob 7s cubic-bezier(0.5, 0, 0.5, 1) infinite both;
            animation: bob 7s cubic-bezier(0.5, 0, 0.5, 1) infinite both;
        }

        .all {
            top: 10rem;
            left: calc(50% - 2.5rem);
            position: absolute;
            width: 8rem;
            height: 5rem;
            -webkit-transform-origin: center -20rem;
            transform-origin: center -20rem;
            -webkit-animation: swing 7s cubic-bezier(0.5, 0, 0.5, 1) infinite both;
            animation: swing 7s cubic-bezier(0.5, 0, 0.5, 1) infinite both;
        }
        .all:before {
            height: 20rem;
            width: 2px;
            background-color: #DB242A;
            left: calc(50% - 1px);
            bottom: 20rem;
        }

        .yarn {
            position: absolute;
            top: 0;
            left: 0;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-image: radial-gradient(circle at top left, #e97c7f, #DB242A 50%, #af1d22);
            z-index: 1;
        }
        .yarn:before, .yarn:after {
            position: absolute;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: white;
            top: -1px;
        }
        .yarn:before {
            left: calc(50% + 7px);
            background-color: #b1bce6;
        }
        .yarn:after {
            right: calc(50% + 7px);
            background-color: #D5E8F8;
        }

        .cat-wrap {
            position: absolute;
            top: 0;
            left: calc(50% - 45px);
            width: 90px;
            height: 130px;
            -webkit-animation: reverse-swing 7s cubic-bezier(0.5, 0, 0.5, 1) infinite both;
            animation: reverse-swing 7s cubic-bezier(0.5, 0, 0.5, 1) infinite both;
            -webkit-transform-origin: top center;
            transform-origin: top center;
        }

        .cat {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            -webkit-animation: swing 7s 0.2s infinite both;
            animation: swing 7s 0.2s infinite both;
            -webkit-transform-origin: top center;
            transform-origin: top center;
        }

        .cat-upper {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            -webkit-transform-origin: top center;
            transform-origin: top center;
            z-index: 1;
        }
        .cat-upper .cat-leg {
            position: absolute;
            width: 20px;
            height: 100%;
            background-color: white;
            z-index: -1;
            background-image: linear-gradient(to right, #D5E8F8, #D5E8F8 20%, #8B9BD9);
        }
        .cat-upper .cat-leg:nth-child(1) {
            border-top-left-radius: 100px;
            left: 10px;
        }
        .cat-upper .cat-leg:nth-child(1):after {
            left: 50%;
        }
        .cat-upper .cat-leg:nth-child(2) {
            border-top-left-radius: 0;
            border-top-right-radius: 100px;
            right: 10px;
        }
        .cat-upper .cat-leg:nth-child(2):after {
            right: 50%;
        }

        .cat-lower-wrap {
            height: 90%;
            width: 100%;
            position: absolute;
            top: 100%;
            width: 75px;
            left: calc(50% - 37.5px);
            -webkit-animation: reverse-swing 7s 0.2s infinite both;
            animation: reverse-swing 7s 0.2s infinite both;
            -webkit-transform-origin: top center;
            transform-origin: top center;
        }

        .cat-lower {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            -webkit-animation: swing 7s 0.5s infinite both;
            animation: swing 7s 0.5s infinite both;
            -webkit-transform-origin: top center;
            transform-origin: top center;
        }
        .cat-lower:after {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 100px;
            background-image: radial-gradient(circle at 10px 50px, white, white 40%, #D5E8F8 65%, #8B9BD9);
            z-index: 1;
        }
        .cat-lower .cat-leg, .cat-lower .cat-paw {
            z-index: -1;
            position: absolute;
            height: 20px;
            width: 20px;
            -webkit-animation: swing-leg 7s 0.3s infinite both;
            animation: swing-leg 7s 0.3s infinite both;
            z-index: 1;
            -webkit-transform-origin: top center;
            transform-origin: top center;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            background-image: linear-gradient(to right, white, #D5E8F8, #8B9BD9);
        }
        .cat-lower > .cat-leg {
            bottom: 20px;
        }
        .cat-lower > .cat-leg .cat-leg {
            top: 25%;
        }
        .cat-lower > .cat-leg + .cat-leg {
            right: 0;
        }
        .cat-lower .cat-paw {
            top: 50%;
            border-radius: 50%;
            background-color: #fff;
        }
        .cat-lower .cat-tail {
            position: absolute;
            height: 15px;
            width: 10px;
            -webkit-animation: swing-tail 7s cubic-bezier(0.5, 0, 0.5, 1) infinite both;
            animation: swing-tail 7s cubic-bezier(0.5, 0, 0.5, 1) infinite both;
            -webkit-transform-origin: top center;
            transform-origin: top center;
            z-index: 0;
            background-image: linear-gradient(to right, white, #D5E8F8, #8B9BD9);
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }
        .cat-lower .cat-tail > .cat-tail {
            top: 50%;
        }
        .cat-lower > .cat-tail {
            left: calc(50% - 5px);
            top: 95%;
        }

        .cat-head {
            width: 90px;
            height: 90px;
            background-image: radial-gradient(circle at 10px 10px, white, white 40%, #D5E8F8 65%, #8B9BD9);
            border-radius: 50%;
            top: calc(100% - 45px);
        }

        .cat-face {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            -webkit-animation: face 7s cubic-bezier(0.5, 0, 0.5, 1) infinite both;
            animation: face 7s cubic-bezier(0.5, 0, 0.5, 1) infinite both;
            -webkit-transform-style: preserve-3d;
            transform-style: preserve-3d;
            -webkit-perspective: 100px;
            perspective: 100px;
        }

        .cat-ears {
            position: absolute;
            top: 0;
            left: 0;
            height: 50%;
            width: 100%;
            z-index: -1;
        }

        .cat-ear {
            width: 20px;
            height: 100%;
            position: absolute;
            border-radius: 5px;
            top: -10px;
        }
        .cat-ear:first-child {
            left: 0;
            -webkit-transform-origin: top left;
            transform-origin: top left;
            -webkit-transform: skewY(40deg);
            transform: skewY(40deg);
            background-color: white;
        }
        .cat-ear:first-child:before {
            left: 0;
            border-top-right-radius: 50%;
            border-bottom-right-radius: 50%;
            background-color: #D7EBFB;
        }
        .cat-ear:last-child {
            right: 0;
            -webkit-transform-origin: top right;
            transform-origin: top right;
            -webkit-transform: skewY(-40deg);
            transform: skewY(-40deg);
            background-color: #d1e6f7;
        }
        .cat-ear:last-child:before {
            right: 0;
            border-top-left-radius: 50%;
            border-bottom-left-radius: 50%;
            background-color: #e0f0fc;
        }
        .cat-ear:before {
            width: 60%;
            height: 100%;
            top: 10px;
            position: absolute;
            background-color: #fff;
        }

        .cat-eyes {
            position: absolute;
            top: 50%;
            width: 100%;
            height: 6px;
            -webkit-animation: blink 7s step-end infinite both;
            animation: blink 7s step-end infinite both;
        }
        .cat-eyes:before, .cat-eyes:after {
            position: absolute;
            height: 6px;
            width: 6px;
            border-radius: 50%;
            background-color: #4B4D75;
        }
        .cat-eyes:before {
            left: 20px;
        }
        .cat-eyes:after {
            right: 20px;
        }

        .cat-mouth {
            position: absolute;
            width: 12px;
            height: 8px;
            background-color: #4B4D75;
            top: 60%;
            left: calc(50% - 6px);
            border-top-left-radius: 50% 30%;
            border-top-right-radius: 50% 30%;
            border-bottom-left-radius: 50% 70%;
            border-bottom-right-radius: 50% 70%;
            -webkit-transform: translateZ(10px);
            transform: translateZ(10px);
        }
        .cat-mouth:before, .cat-mouth:after {
            position: absolute;
            width: 90%;
            height: 100%;
            border: 2px solid #9FA2CB;
            top: 80%;
            border-radius: 100px;
            border-top-color: transparent;
            z-index: -1;
        }
        .cat-mouth:before {
            border-left-color: transparent;
            right: calc(50% - 1px);
            -webkit-transform-origin: top right;
            transform-origin: top right;
            -webkit-transform: rotate(10deg);
            transform: rotate(10deg);
        }
        .cat-mouth:after {
            border-right-color: transparent;
            left: calc(50% - 1px);
            -webkit-transform-origin: top left;
            transform-origin: top left;
            -webkit-transform: rotate(-10deg);
            transform: rotate(-10deg);
        }

        .cat-whiskers {
            width: 50%;
            height: 8px;
            position: absolute;
            bottom: 25%;
            left: 25%;
            -webkit-transform-style: preserve-3d;
            transform-style: preserve-3d;
            -webkit-perspective: 60px;
            perspective: 60px;
        }
        .cat-whiskers:before, .cat-whiskers:after {
            position: absolute;
            height: 100%;
            width: 30%;
            border: 2px solid #9FA2CB;
            border-left: none;
            border-right: none;
        }
        .cat-whiskers:before {
            right: 100%;
            -webkit-transform-origin: right center;
            transform-origin: right center;
            -webkit-transform: rotateY(70deg) rotateZ(-10deg);
            transform: rotateY(70deg) rotateZ(-10deg);
        }
        .cat-whiskers:after {
            left: 100%;
            -webkit-transform-origin: left center;
            transform-origin: left center;
            -webkit-transform: rotateY(-70deg) rotateZ(10deg);
            transform: rotateY(-70deg) rotateZ(10deg);
        }

        @-webkit-keyframes bob {
            0% {
                -webkit-transform: translateY(0.4rem);
                transform: translateY(0.4rem);
            }
            6.25% {
                -webkit-transform: translateY(-0.4rem);
                transform: translateY(-0.4rem);
            }
            12.5% {
                -webkit-transform: translateY(0.4rem);
                transform: translateY(0.4rem);
            }
            18.75% {
                -webkit-transform: translateY(-0.4rem);
                transform: translateY(-0.4rem);
            }
            25% {
                -webkit-transform: translateY(0.4rem);
                transform: translateY(0.4rem);
            }
            31.25% {
                -webkit-transform: translateY(-0.4rem);
                transform: translateY(-0.4rem);
            }
            37.5% {
                -webkit-transform: translateY(0.4rem);
                transform: translateY(0.4rem);
            }
            43.75% {
                -webkit-transform: translateY(-0.4rem);
                transform: translateY(-0.4rem);
            }
            50% {
                -webkit-transform: translateY(0.4rem);
                transform: translateY(0.4rem);
            }
            56.25% {
                -webkit-transform: translateY(-0.4rem);
                transform: translateY(-0.4rem);
            }
            62.5% {
                -webkit-transform: translateY(0.4rem);
                transform: translateY(0.4rem);
            }
            68.75% {
                -webkit-transform: translateY(-0.4rem);
                transform: translateY(-0.4rem);
            }
            75% {
                -webkit-transform: translateY(0.4rem);
                transform: translateY(0.4rem);
            }
            81.25% {
                -webkit-transform: translateY(-0.4rem);
                transform: translateY(-0.4rem);
            }
            87.5% {
                -webkit-transform: translateY(0.4rem);
                transform: translateY(0.4rem);
            }
            93.75% {
                -webkit-transform: translateY(-0.4rem);
                transform: translateY(-0.4rem);
            }
            100% {
                -webkit-transform: translateY(0.4rem);
                transform: translateY(0.4rem);
            }
        }

        @keyframes bob {
            0% {
                -webkit-transform: translateY(0.4rem);
                transform: translateY(0.4rem);
            }
            6.25% {
                -webkit-transform: translateY(-0.4rem);
                transform: translateY(-0.4rem);
            }
            12.5% {
                -webkit-transform: translateY(0.4rem);
                transform: translateY(0.4rem);
            }
            18.75% {
                -webkit-transform: translateY(-0.4rem);
                transform: translateY(-0.4rem);
            }
            25% {
                -webkit-transform: translateY(0.4rem);
                transform: translateY(0.4rem);
            }
            31.25% {
                -webkit-transform: translateY(-0.4rem);
                transform: translateY(-0.4rem);
            }
            37.5% {
                -webkit-transform: translateY(0.4rem);
                transform: translateY(0.4rem);
            }
            43.75% {
                -webkit-transform: translateY(-0.4rem);
                transform: translateY(-0.4rem);
            }
            50% {
                -webkit-transform: translateY(0.4rem);
                transform: translateY(0.4rem);
            }
            56.25% {
                -webkit-transform: translateY(-0.4rem);
                transform: translateY(-0.4rem);
            }
            62.5% {
                -webkit-transform: translateY(0.4rem);
                transform: translateY(0.4rem);
            }
            68.75% {
                -webkit-transform: translateY(-0.4rem);
                transform: translateY(-0.4rem);
            }
            75% {
                -webkit-transform: translateY(0.4rem);
                transform: translateY(0.4rem);
            }
            81.25% {
                -webkit-transform: translateY(-0.4rem);
                transform: translateY(-0.4rem);
            }
            87.5% {
                -webkit-transform: translateY(0.4rem);
                transform: translateY(0.4rem);
            }
            93.75% {
                -webkit-transform: translateY(-0.4rem);
                transform: translateY(-0.4rem);
            }
            100% {
                -webkit-transform: translateY(0.4rem);
                transform: translateY(0.4rem);
            }
        }
        @-webkit-keyframes swing {
            0% {
                -webkit-transform: rotate(5deg);
                transform: rotate(5deg);
            }
            12.5% {
                -webkit-transform: rotate(-10deg);
                transform: rotate(-10deg);
            }
            25% {
                -webkit-transform: rotate(10deg);
                transform: rotate(10deg);
            }
            37.5% {
                -webkit-transform: rotate(-15deg);
                transform: rotate(-15deg);
            }
            50% {
                -webkit-transform: rotate(23deg);
                transform: rotate(23deg);
            }
            62.5% {
                -webkit-transform: rotate(-23deg);
                transform: rotate(-23deg);
            }
            75% {
                -webkit-transform: rotate(15deg);
                transform: rotate(15deg);
            }
            87.5% {
                -webkit-transform: rotate(-10deg);
                transform: rotate(-10deg);
            }
            100% {
                -webkit-transform: rotate(5deg);
                transform: rotate(5deg);
            }
        }
        @keyframes swing {
            0% {
                -webkit-transform: rotate(5deg);
                transform: rotate(5deg);
            }
            12.5% {
                -webkit-transform: rotate(-10deg);
                transform: rotate(-10deg);
            }
            25% {
                -webkit-transform: rotate(10deg);
                transform: rotate(10deg);
            }
            37.5% {
                -webkit-transform: rotate(-15deg);
                transform: rotate(-15deg);
            }
            50% {
                -webkit-transform: rotate(23deg);
                transform: rotate(23deg);
            }
            62.5% {
                -webkit-transform: rotate(-23deg);
                transform: rotate(-23deg);
            }
            75% {
                -webkit-transform: rotate(15deg);
                transform: rotate(15deg);
            }
            87.5% {
                -webkit-transform: rotate(-10deg);
                transform: rotate(-10deg);
            }
            100% {
                -webkit-transform: rotate(5deg);
                transform: rotate(5deg);
            }
        }
        @-webkit-keyframes swing-leg {
            0% {
                -webkit-transform: rotate(0.5deg);
                transform: rotate(0.5deg);
            }
            12.5% {
                -webkit-transform: rotate(-1deg);
                transform: rotate(-1deg);
            }
            25% {
                -webkit-transform: rotate(1deg);
                transform: rotate(1deg);
            }
            37.5% {
                -webkit-transform: rotate(-1.5deg);
                transform: rotate(-1.5deg);
            }
            50% {
                -webkit-transform: rotate(2.3deg);
                transform: rotate(2.3deg);
            }
            62.5% {
                -webkit-transform: rotate(-2.3deg);
                transform: rotate(-2.3deg);
            }
            75% {
                -webkit-transform: rotate(1.5deg);
                transform: rotate(1.5deg);
            }
            87.5% {
                -webkit-transform: rotate(-1deg);
                transform: rotate(-1deg);
            }
            100% {
                -webkit-transform: rotate(0.5deg);
                transform: rotate(0.5deg);
            }
        }
        @keyframes swing-leg {
            0% {
                -webkit-transform: rotate(0.5deg);
                transform: rotate(0.5deg);
            }
            12.5% {
                -webkit-transform: rotate(-1deg);
                transform: rotate(-1deg);
            }
            25% {
                -webkit-transform: rotate(1deg);
                transform: rotate(1deg);
            }
            37.5% {
                -webkit-transform: rotate(-1.5deg);
                transform: rotate(-1.5deg);
            }
            50% {
                -webkit-transform: rotate(2.3deg);
                transform: rotate(2.3deg);
            }
            62.5% {
                -webkit-transform: rotate(-2.3deg);
                transform: rotate(-2.3deg);
            }
            75% {
                -webkit-transform: rotate(1.5deg);
                transform: rotate(1.5deg);
            }
            87.5% {
                -webkit-transform: rotate(-1deg);
                transform: rotate(-1deg);
            }
            100% {
                -webkit-transform: rotate(0.5deg);
                transform: rotate(0.5deg);
            }
        }
        @-webkit-keyframes swing-tail {
            0% {
                -webkit-transform: rotate(-2deg);
                transform: rotate(-2deg);
            }
            12.5% {
                -webkit-transform: rotate(4deg);
                transform: rotate(4deg);
            }
            25% {
                -webkit-transform: rotate(-4deg);
                transform: rotate(-4deg);
            }
            37.5% {
                -webkit-transform: rotate(6deg);
                transform: rotate(6deg);
            }
            50% {
                -webkit-transform: rotate(-9.2deg);
                transform: rotate(-9.2deg);
            }
            62.5% {
                -webkit-transform: rotate(9.2deg);
                transform: rotate(9.2deg);
            }
            75% {
                -webkit-transform: rotate(-6deg);
                transform: rotate(-6deg);
            }
            87.5% {
                -webkit-transform: rotate(4deg);
                transform: rotate(4deg);
            }
            100% {
                -webkit-transform: rotate(-2deg);
                transform: rotate(-2deg);
            }
        }
        @keyframes swing-tail {
            0% {
                -webkit-transform: rotate(-2deg);
                transform: rotate(-2deg);
            }
            12.5% {
                -webkit-transform: rotate(4deg);
                transform: rotate(4deg);
            }
            25% {
                -webkit-transform: rotate(-4deg);
                transform: rotate(-4deg);
            }
            37.5% {
                -webkit-transform: rotate(6deg);
                transform: rotate(6deg);
            }
            50% {
                -webkit-transform: rotate(-9.2deg);
                transform: rotate(-9.2deg);
            }
            62.5% {
                -webkit-transform: rotate(9.2deg);
                transform: rotate(9.2deg);
            }
            75% {
                -webkit-transform: rotate(-6deg);
                transform: rotate(-6deg);
            }
            87.5% {
                -webkit-transform: rotate(4deg);
                transform: rotate(4deg);
            }
            100% {
                -webkit-transform: rotate(-2deg);
                transform: rotate(-2deg);
            }
        }
        @-webkit-keyframes reverse-swing {
            0% {
                -webkit-transform: rotate(-5deg);
                transform: rotate(-5deg);
            }
            12.5% {
                -webkit-transform: rotate(10deg);
                transform: rotate(10deg);
            }
            25% {
                -webkit-transform: rotate(-10deg);
                transform: rotate(-10deg);
            }
            37.5% {
                -webkit-transform: rotate(15deg);
                transform: rotate(15deg);
            }
            50% {
                -webkit-transform: rotate(-23deg);
                transform: rotate(-23deg);
            }
            62.5% {
                -webkit-transform: rotate(23deg);
                transform: rotate(23deg);
            }
            75% {
                -webkit-transform: rotate(-15deg);
                transform: rotate(-15deg);
            }
            87.5% {
                -webkit-transform: rotate(10deg);
                transform: rotate(10deg);
            }
            100% {
                -webkit-transform: rotate(-5deg);
                transform: rotate(-5deg);
            }
        }
        @keyframes reverse-swing {
            0% {
                -webkit-transform: rotate(-5deg);
                transform: rotate(-5deg);
            }
            12.5% {
                -webkit-transform: rotate(10deg);
                transform: rotate(10deg);
            }
            25% {
                -webkit-transform: rotate(-10deg);
                transform: rotate(-10deg);
            }
            37.5% {
                -webkit-transform: rotate(15deg);
                transform: rotate(15deg);
            }
            50% {
                -webkit-transform: rotate(-23deg);
                transform: rotate(-23deg);
            }
            62.5% {
                -webkit-transform: rotate(23deg);
                transform: rotate(23deg);
            }
            75% {
                -webkit-transform: rotate(-15deg);
                transform: rotate(-15deg);
            }
            87.5% {
                -webkit-transform: rotate(10deg);
                transform: rotate(10deg);
            }
            100% {
                -webkit-transform: rotate(-5deg);
                transform: rotate(-5deg);
            }
        }
        @-webkit-keyframes face {
            0% {
                -webkit-transform: translateX(-2.5px);
                transform: translateX(-2.5px);
            }
            12.5% {
                -webkit-transform: translateX(5px);
                transform: translateX(5px);
            }
            25% {
                -webkit-transform: translateX(-5px);
                transform: translateX(-5px);
            }
            37.5% {
                -webkit-transform: translateX(7.5px);
                transform: translateX(7.5px);
            }
            50% {
                -webkit-transform: translateX(-11.5px);
                transform: translateX(-11.5px);
            }
            62.5% {
                -webkit-transform: translateX(11.5px);
                transform: translateX(11.5px);
            }
            75% {
                -webkit-transform: translateX(-7.5px);
                transform: translateX(-7.5px);
            }
            87.5% {
                -webkit-transform: translateX(5px);
                transform: translateX(5px);
            }
            100% {
                -webkit-transform: translateX(-2.5px);
                transform: translateX(-2.5px);
            }
        }
        @keyframes face {
            0% {
                -webkit-transform: translateX(-2.5px);
                transform: translateX(-2.5px);
            }
            12.5% {
                -webkit-transform: translateX(5px);
                transform: translateX(5px);
            }
            25% {
                -webkit-transform: translateX(-5px);
                transform: translateX(-5px);
            }
            37.5% {
                -webkit-transform: translateX(7.5px);
                transform: translateX(7.5px);
            }
            50% {
                -webkit-transform: translateX(-11.5px);
                transform: translateX(-11.5px);
            }
            62.5% {
                -webkit-transform: translateX(11.5px);
                transform: translateX(11.5px);
            }
            75% {
                -webkit-transform: translateX(-7.5px);
                transform: translateX(-7.5px);
            }
            87.5% {
                -webkit-transform: translateX(5px);
                transform: translateX(5px);
            }
            100% {
                -webkit-transform: translateX(-2.5px);
                transform: translateX(-2.5px);
            }
        }
        @-webkit-keyframes fade-in {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        @keyframes fade-in {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        @-webkit-keyframes blink {
            from, to, 10%, 25%, 80% {
                -webkit-transform: scaleY(1);
                transform: scaleY(1);
            }
            8%, 23%, 78% {
                -webkit-transform: scaleY(0.1);
                transform: scaleY(0.1);
            }
        }
        @keyframes blink {
            from, to, 10%, 25%, 80% {
                -webkit-transform: scaleY(1);
                transform: scaleY(1);
            }
            8%, 23%, 78% {
                -webkit-transform: scaleY(0.1);
                transform: scaleY(0.1);
            }
        }
    </style>
@endpush

@section('content')

    <h1 class="error-text fadeIn animated" style="position: fixed;">{{ __('jarboe::common.errors.404_title') }}</h1>

    <!-- https://codepen.io/davidkpiano/pen/Xempjq -->
    <div class="all-wrap">
        <div class="all">
            <div class="yarn"></div>
            <div class="cat-wrap">
                <div class="cat">
                    <div class="cat-upper">
                        <div class="cat-leg"></div>
                        <div class="cat-leg"></div>
                        <div class="cat-head">
                            <div class="cat-ears">
                                <div class="cat-ear"></div>
                                <div class="cat-ear"></div>
                            </div>
                            <div class="cat-face">
                                <div class="cat-eyes"></div>
                                <div class="cat-mouth"></div>
                                <div class="cat-whiskers"></div>
                            </div>
                        </div>
                    </div>
                    <div class="cat-lower-wrap">
                        <div class="cat-lower">
                            <div class="cat-leg">
                                <div class="cat-leg">
                                    <div class="cat-leg">
                                        <div class="cat-leg">
                                            <div class="cat-leg">
                                                <div class="cat-leg">
                                                    <div class="cat-leg">
                                                        <div class="cat-leg">
                                                            <div class="cat-leg">
                                                                <div class="cat-leg">
                                                                    <div class="cat-leg">
                                                                        <div class="cat-leg">
                                                                            <div class="cat-leg">
                                                                                <div class="cat-leg">
                                                                                    <div class="cat-leg">
                                                                                        <div class="cat-leg">
                                                                                            <div class="cat-paw"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cat-leg">
                                <div class="cat-leg">
                                    <div class="cat-leg">
                                        <div class="cat-leg">
                                            <div class="cat-leg">
                                                <div class="cat-leg">
                                                    <div class="cat-leg">
                                                        <div class="cat-leg">
                                                            <div class="cat-leg">
                                                                <div class="cat-leg">
                                                                    <div class="cat-leg">
                                                                        <div class="cat-leg">
                                                                            <div class="cat-leg">
                                                                                <div class="cat-leg">
                                                                                    <div class="cat-leg">
                                                                                        <div class="cat-leg">
                                                                                            <div class="cat-paw"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cat-tail">
                                <div class="cat-tail">
                                    <div class="cat-tail">
                                        <div class="cat-tail">
                                            <div class="cat-tail">
                                                <div class="cat-tail">
                                                    <div class="cat-tail">
                                                        <div class="cat-tail">
                                                            <div class="cat-tail">
                                                                <div class="cat-tail">
                                                                    <div class="cat-tail">
                                                                        <div class="cat-tail">
                                                                            <div class="cat-tail">
                                                                                <div class="cat-tail">
                                                                                    <div class="cat-tail">
                                                                                        <div class="cat-tail -end"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
