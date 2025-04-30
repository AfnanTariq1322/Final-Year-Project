import 'package:flutter/material.dart';

class GlobalFunctions {
  nextScreen(BuildContext context, screenName) {
    //  connectivityService.cancelSubscription(screenName: screenName);
    Future.delayed(const Duration(milliseconds: 200), () {
      if (context.mounted) {
        Navigator.push(
          context,
          MaterialPageRoute(builder: (context) => screenName),
        );
      }
    });
  }

  nextScreenPushReplacement(BuildContext context, screenName) {
    // connectivityService.cancelSubscription(screenName: screenName);
    Future.delayed(const Duration(milliseconds: 200), () {
      if (context.mounted) {
        Navigator.pushReplacement(
          context,
          MaterialPageRoute(builder: (context) => screenName),
        );
      }
    });
  }

  void nextScreenPushRemoveUntil(BuildContext context, Widget screenName) {
    Future.delayed(const Duration(milliseconds: 200), () {
      // connectivityService.cancelSubscription(screenName: screenName);
      if (context.mounted) {
        Navigator.pushAndRemoveUntil(
          context,
          MaterialPageRoute(builder: (context) => screenName),
          (Route<dynamic> route) => false,
        );
      }
    });
  }

  popScreen(BuildContext context) {
    Navigator.pop(context);
  }
}
