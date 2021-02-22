import React from "react";
import Svg, {Path} from "react-native-svg"
import {SIconButton, ButtonProps} from "./SButton";


function BackIcon({style, onPress}: ButtonProps) {
    return (
        <SIconButton
            onPress={onPress}
            style={{...style}}>
            <Svg
                fill="none"
                stroke="#fff"
                viewBox={`0 0 30 20`}
            >
                <Path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth={3}
                    d="M15 19l-7-7 7-7"
                />
            </Svg>
        </SIconButton>
    )
}

export default BackIcon;