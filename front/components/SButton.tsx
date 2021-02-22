import React from 'react';
import {View, Button, StyleSheet, TouchableOpacity, Text, ViewStyle, TextStyle} from "react-native";

export interface ButtonProps {
    onPress: () => void,
    title?: string,
    style?: ViewStyle,
    textStyle?: TextStyle,
    children?: any
}

const SButton = ({onPress, title = "", style = {}, textStyle = {}}: ButtonProps) => (
    <TouchableOpacity onPress={onPress} style={{
        ...styles.buttonStyle,
        ...style
    }}>
        <Text style={{...styles.textButtonStyle, ...textStyle}}>{title}</Text>
    </TouchableOpacity>
);

export const SPrimaryButton = ({onPress, title, style={}, textStyle = {}}: ButtonProps) => (
    <SButton
        title={title}
        onPress={onPress}
        style={{
            ...style,
            ...styles.primaryButtonStyle
        }}
        textStyle={textStyle}
    />
);

export const SOutlinedButton = ({onPress, title, style={}, textStyle = {}}: ButtonProps) => (
    <SButton
        title={title}
        onPress={onPress}
        style={{
            ...style,
            ...styles.outlinedButtonStyle
        }}
        textStyle={{
            ...textStyle,
            ...styles.outlinedTextButtonStyle
        }}
    />
);

export const SIconButton = ({children, onPress, style = {}, textStyle = {}}: ButtonProps) => (
    <TouchableOpacity onPress={onPress} style={{
        ...style,
        ...styles.buttonStyle,
        ...styles.iconButtonStyle,
    }}>
        {children}
    </TouchableOpacity>
);


export default SButton;

const styles = StyleSheet.create({
    buttonStyle: {
        elevation: 8,
        borderRadius: 5,
        paddingVertical: 10,
        paddingHorizontal: 12
    },

    iconButtonStyle: {
        elevation: 0,
        paddingVertical: 0,
        paddingHorizontal: 0
    },

    primaryButtonStyle: {
        backgroundColor: "dodgerblue",
    },

    outlinedButtonStyle: {
        backgroundColor: "#fff",
        borderColor: "#fd886a",
        borderWidth: 1,
        elevation: 0
    },

    outlinedTextButtonStyle: {
        color: "#fd886a"
    },

    textButtonStyle: {
        fontSize: 18,
        color: "#fff",
        fontWeight: "bold",
        alignSelf: "center",
    },
});