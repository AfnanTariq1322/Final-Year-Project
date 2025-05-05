// ignore_for_file: avoid_print, curly_braces_in_flow_control_structures

import 'package:eye_disease_detection_app/functions/global_functions.dart';
import 'package:eye_disease_detection_app/pages/blog_detail_page/blog_detail_page.dart';
import 'package:eye_disease_detection_app/services/api_services/api_services.dart';
import 'package:flutter/material.dart';
import 'dart:convert';
import 'package:http/http.dart' as http;

class BlogsScreen extends StatefulWidget {
  const BlogsScreen({super.key});

  @override
  State<BlogsScreen> createState() => _BlogsScreenState();
}

class _BlogsScreenState extends State<BlogsScreen> {
  List categories = [];
  List blogs = [];
  int? selectedCategoryId;
  bool _isLoading = true;
  String? _errorMessage;

  @override
  void initState() {
    super.initState();
    getBlogAndCategories();
  }

  Future<void> getBlogAndCategories() async {
    setState(() {
      _isLoading = true;
      _errorMessage = null;
    });

    try {
      final response = await http
          .get(Uri.parse('${ApiServices().baseUrl}/blogs-categories'))
          .timeout(const Duration(seconds: 10));

      if (response.statusCode == 200) {
        final data = jsonDecode(response.body);
        setState(() {
          categories = data['categories'] ?? [];
          blogs = data['blogs'] ?? [];
          _isLoading = false;
        });
      } else {
        setState(() {
          _errorMessage = 'Failed to fetch data: ${response.statusCode}';
          _isLoading = false;
        });
        debugPrint('${response.statusCode} ${response.body}');
      }
    } catch (e) {
      setState(() {
        _errorMessage = 'Error: $e';
        _isLoading = false;
      });
      debugPrint('Error: $e');
    }
  }

  List get filteredBlogs {
    if (selectedCategoryId == null) return blogs;
    return blogs
        .where((blog) => blog['category']['id'] == selectedCategoryId)
        .toList();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
        decoration: const BoxDecoration(
          gradient: LinearGradient(
            begin: Alignment.topCenter,
            end: Alignment.bottomCenter,
            colors: [
              Color(0xFF6A1B9A),
              Color(0xFF4A148C),
            ],
          ),
        ),
        child: SafeArea(
          child: Column(
            children: [
              Padding(
                padding: const EdgeInsets.all(16.0),
                child: Row(
                  children: [
                    IconButton(
                      icon: const Icon(Icons.arrow_back, color: Colors.white),
                      onPressed: () => Navigator.pop(context),
                    ),
                    const SizedBox(width: 8),
                    const Text(
                      "Eye Care Blogs",
                      style: TextStyle(
                        fontSize: 24,
                        fontWeight: FontWeight.bold,
                        color: Colors.white,
                      ),
                    ),
                  ],
                ),
              ),
              _isLoading
                  ? const Expanded(
                      child: Center(
                        child: CircularProgressIndicator(
                          color: Colors.white,
                        ),
                      ),
                    )
                  : _errorMessage != null
                      ? Expanded(
                          child: Center(
                            child: Column(
                              mainAxisAlignment: MainAxisAlignment.center,
                              children: [
                                Text(
                                  _errorMessage!,
                                  style: const TextStyle(
                                    color: Colors.white,
                                    fontSize: 16,
                                  ),
                                  textAlign: TextAlign.center,
                                ),
                                const SizedBox(height: 20),
                                ElevatedButton(
                                  onPressed: getBlogAndCategories,
                                  style: ElevatedButton.styleFrom(
                                    backgroundColor: Colors.white,
                                    foregroundColor: const Color(0xFF6A1B9A),
                                    padding: const EdgeInsets.symmetric(
                                      horizontal: 32,
                                      vertical: 12,
                                    ),
                                    shape: RoundedRectangleBorder(
                                      borderRadius: BorderRadius.circular(30),
                                    ),
                                  ),
                                  child: const Text('Retry'),
                                ),
                              ],
                            ),
                          ),
                        )
                      : Expanded(
                          child: Column(
                            children: [
                              SizedBox(
                                height: 50,
                                child: ListView.builder(
                                  scrollDirection: Axis.horizontal,
                                  itemCount: categories.length + 1,
                                  itemBuilder: (context, index) {
                                    if (index == 0) {
                                      return GestureDetector(
                                        onTap: () => setState(
                                            () => selectedCategoryId = null),
                                        child: Container(
                                          padding: const EdgeInsets.symmetric(
                                              horizontal: 16, vertical: 8),
                                          margin: const EdgeInsets.symmetric(
                                              horizontal: 6, vertical: 8),
                                          decoration: BoxDecoration(
                                            color: selectedCategoryId == null
                                                ? Colors.white
                                                : Colors.white.withOpacity(0.2),
                                            borderRadius:
                                                BorderRadius.circular(25),
                                            boxShadow: [
                                              BoxShadow(
                                                color: Colors.black
                                                    .withOpacity(0.1),
                                                blurRadius: 4,
                                                offset: const Offset(0, 2),
                                              ),
                                            ],
                                          ),
                                          child: Center(
                                            child: Text(
                                              "All",
                                              style: TextStyle(
                                                fontWeight: FontWeight.bold,
                                                color: selectedCategoryId == null
                                                    ? const Color(0xFF6A1B9A)
                                                    : Colors.white,
                                              ),
                                            ),
                                          ),
                                        ),
                                      );
                                    }
                                    final category = categories[index - 1];
                                    return GestureDetector(
                                      onTap: () => setState(() =>
                                          selectedCategoryId = category['id']),
                                      child: Container(
                                        padding: const EdgeInsets.symmetric(
                                            horizontal: 16, vertical: 8),
                                        margin: const EdgeInsets.symmetric(
                                            horizontal: 6, vertical: 8),
                                        decoration: BoxDecoration(
                                          color: selectedCategoryId ==
                                                  category['id']
                                              ? Colors.white
                                              : Colors.white.withOpacity(0.2),
                                          borderRadius:
                                              BorderRadius.circular(25),
                                          boxShadow: [
                                            BoxShadow(
                                              color:
                                                  Colors.black.withOpacity(0.1),
                                              blurRadius: 4,
                                              offset: const Offset(0, 2),
                                            ),
                                          ],
                                        ),
                                        child: Center(
                                          child: Text(
                                            category['name'],
                                            style: TextStyle(
                                              fontWeight: FontWeight.bold,
                                              color: selectedCategoryId ==
                                                      category['id']
                                                  ? const Color(0xFF6A1B9A)
                                                  : Colors.white,
                                            ),
                                          ),
                                        ),
                                      ),
                                    );
                                  },
                                ),
                              ),
                              const SizedBox(height: 16),
                              Expanded(
                                child: filteredBlogs.isEmpty
                                    ? const Center(
                                        child: Text(
                                          'No blogs found',
                                          style: TextStyle(
                                            fontSize: 16,
                                            color: Colors.white,
                                          ),
                                        ),
                                      )
                                    : ListView.builder(
                                        padding: const EdgeInsets.symmetric(
                                            horizontal: 16),
                                        itemCount: filteredBlogs.length,
                                        itemBuilder: (context, index) {
                                          final blog = filteredBlogs[index];
                                          final category = blog['category'];
                                          final comments =
                                              blog['comments'] as List;

                                          // Assuming disease data is available
                                          final disease = blog['disease'];

                                          return GestureDetector(
                                            onTap: () {
                                              GlobalFunctions().nextScreen(
                                                  context,
                                                  BlogDetailPage(
                                                      blogId: blog['id']));
                                            },
                                            child: Container(
                                              margin: const EdgeInsets.only(
                                                  bottom: 16),
                                              decoration: BoxDecoration(
                                                color: Colors.white,
                                                borderRadius:
                                                    BorderRadius.circular(16),
                                                boxShadow: [
                                                  BoxShadow(
                                                    color: Colors.black
                                                        .withOpacity(0.1),
                                                    blurRadius: 10,
                                                    offset: const Offset(0, 4),
                                                  ),
                                                ],
                                              ),
                                              child: Column(
                                                crossAxisAlignment:
                                                    CrossAxisAlignment.start,
                                                children: [
                                                  // Blog Image Section
                                                  if (blog['image'] != null)
                                                    ClipRRect(
                                                      borderRadius:
                                                          const BorderRadius
                                                              .vertical(
                                                              top: Radius
                                                                  .circular(16)),
                                                      child: Image.network(
                                                        'http://10.0.2.2:8000/storage/${blog['image']}',
                                                        height: 200,
                                                        width: double.infinity,
                                                        fit: BoxFit.cover,
                                                        loadingBuilder: (context,
                                                            child,
                                                            loadingProgress) {
                                                          if (loadingProgress ==
                                                              null) {
                                                            return child;
                                                          }
                                                          print(
                                                              'Loading blog image: http://10.0.2.2:8000/storage/${blog['image']}');
                                                          return Container(
                                                            height: 200,
                                                            color: Colors
                                                                .grey[200],
                                                            child: Center(
                                                              child:
                                                                  CircularProgressIndicator(
                                                                value: loadingProgress
                                                                            .expectedTotalBytes !=
                                                                        null
                                                                    ? loadingProgress
                                                                            .cumulativeBytesLoaded /
                                                                        (loadingProgress
                                                                            .expectedTotalBytes ??
                                                                            1)
                                                                    : null,
                                                                color: const Color(
                                                                    0xFF6A1B9A),
                                                              ),
                                                            ),
                                                          );
                                                        },
                                                        errorBuilder: (context,
                                                            error, stackTrace) {
                                                          print(
                                                              'Error loading blog image: $error');
                                                          return Container(
                                                            height: 200,
                                                            color: Colors
                                                                .grey[200],
                                                            child: Column(
                                                              mainAxisAlignment:
                                                                  MainAxisAlignment
                                                                      .center,
                                                              children: [
                                                                const Icon(
                                                                  Icons
                                                                      .image_not_supported_outlined,
                                                                  color: Colors
                                                                      .grey,
                                                                  size: 40,
                                                                ),
                                                                const SizedBox(
                                                                    height: 8),
                                                                Text(
                                                                  'Image not available',
                                                                  style:
                                                                      TextStyle(
                                                                    color: Colors
                                                                            .grey[
                                                                        600],
                                                                    fontSize:
                                                                        14,
                                                                  ),
                                                                ),
                                                              ],
                                                            ),
                                                          );
                                                        },
                                                      ),
                                                    ),
                                                  // Disease Image Section
                                                  if (disease != null &&
                                                      disease['image'] != null)
                                                    Container(
                                                      height: 200,
                                                      width: double.infinity,
                                                      decoration: BoxDecoration(
                                                        color: Colors.grey[200],
                                                        borderRadius:
                                                            const BorderRadius
                                                                .vertical(
                                                                top: Radius
                                                                    .circular(
                                                                        16)),
                                                      ),
                                                      child: Column(
                                                        crossAxisAlignment:
                                                            CrossAxisAlignment
                                                                .start,
                                                        children: [
                                                          Padding(
                                                            padding:
                                                                const EdgeInsets
                                                                    .all(8.0),
                                                            child: Container(
                                                              padding:
                                                                  const EdgeInsets
                                                                      .symmetric(
                                                                horizontal: 12,
                                                                vertical: 6,
                                                              ),
                                                              decoration:
                                                                  BoxDecoration(
                                                                color: const Color(
                                                                        0xFF6A1B9A)
                                                                    .withOpacity(
                                                                        0.8),
                                                                borderRadius:
                                                                    BorderRadius
                                                                        .circular(
                                                                            20),
                                                              ),
                                                              child: Text(
                                                                disease['name'] ??
                                                                    'Related Disease',
                                                                style:
                                                                    const TextStyle(
                                                                  color: Colors
                                                                      .white,
                                                                  fontWeight:
                                                                      FontWeight
                                                                          .bold,
                                                                ),
                                                              ),
                                                            ),
                                                          ),
                                                          Expanded(
                                                            child: ClipRRect(
                                                              borderRadius:
                                                                  const BorderRadius
                                                                      .vertical(
                                                                bottom: Radius
                                                                    .circular(
                                                                        16),
                                                              ),
                                                              child:
                                                                  Image.network(
                                                                'http://10.0.2.2:8000/storage/${disease['image']}',
                                                                height: 150,
                                                                width: double
                                                                    .infinity,
                                                                fit: BoxFit
                                                                    .cover,
                                                                loadingBuilder:
                                                                    (context,
                                                                        child,
                                                                        loadingProgress) {
                                                                  if (loadingProgress ==
                                                                      null) {
                                                                    return child;
                                                                  }
                                                                  print(
                                                                      'Loading disease image: http://10.0.2.2:8000/storage/${disease['image']}');
                                                                  return Container(
                                                                    color: Colors
                                                                            .grey[
                                                                        200],
                                                                    child:
                                                                        Center(
                                                                      child:
                                                                          CircularProgressIndicator(
                                                                        value: loadingProgress
                                                                                    .expectedTotalBytes !=
                                                                                null
                                                                            ? loadingProgress
                                                                                    .cumulativeBytesLoaded /
                                                                                (loadingProgress.expectedTotalBytes ??
                                                                                    1)
                                                                            : null,
                                                                        color: const Color(
                                                                            0xFF6A1B9A),
                                                                      ),
                                                                    ),
                                                                  );
                                                                },
                                                                errorBuilder:
                                                                    (context,
                                                                        error,
                                                                        stackTrace) {
                                                                  print(
                                                                      'Error loading disease image: $error');
                                                                  return Container(
                                                                    color: Colors
                                                                            .grey[
                                                                        200],
                                                                    child:
                                                                        Column(
                                                                      mainAxisAlignment:
                                                                          MainAxisAlignment
                                                                              .center,
                                                                      children: [
                                                                        const Icon(
                                                                          Icons
                                                                              .image_not_supported_outlined,
                                                                          color:
                                                                              Colors.grey,
                                                                          size:
                                                                              40,
                                                                        ),
                                                                        const SizedBox(
                                                                            height:
                                                                                8),
                                                                        Text(
                                                                          'Disease image not available',
                                                                          style:
                                                                              TextStyle(
                                                                            color:
                                                                                Colors.grey[600],
                                                                            fontSize:
                                                                                14,
                                                                          ),
                                                                        ),
                                                                      ],
                                                                    ),
                                                                  );
                                                                },
                                                              ),
                                                            ),
                                                          ),
                                                        ],
                                                      ),
                                                    ),
                                                  Padding(
                                                    padding:
                                                        const EdgeInsets.all(
                                                            16),
                                                    child: Column(
                                                      crossAxisAlignment:
                                                          CrossAxisAlignment
                                                              .start,
                                                      children: [
                                                        Container(
                                                          padding:
                                                              const EdgeInsets
                                                                  .symmetric(
                                                                  horizontal:
                                                                      12,
                                                                  vertical: 6),
                                                          decoration:
                                                              BoxDecoration(
                                                            color: const Color(
                                                                    0xFF6A1B9A)
                                                                .withOpacity(
                                                                    0.1),
                                                            borderRadius:
                                                                BorderRadius
                                                                    .circular(
                                                                        20),
                                                          ),
                                                          child: Text(
                                                            category['name'],
                                                            style:
                                                                const TextStyle(
                                                              color: Color(
                                                                  0xFF6A1B9A),
                                                              fontWeight:
                                                                  FontWeight
                                                                      .bold,
                                                            ),
                                                          ),
                                                        ),
                                                        const SizedBox(
                                                            height: 12),
                                                        Text(
                                                          blog['title'],
                                                          style:
                                                              const TextStyle(
                                                            fontSize: 20,
                                                            fontWeight:
                                                                FontWeight.bold,
                                                            color:
                                                                Colors.black87,
                                                          ),
                                                        ),
                                                        const SizedBox(
                                                            height: 8),
                                                        Text(
                                                          blog['content']
                                                                      .replaceAll(
                                                                          RegExp(
                                                                              r'<[^>]*>|&[^;]+;'),
                                                                          '')
                                                                      .length >
                                                                  150
                                                              ? blog['content']
                                                                      .replaceAll(
                                                                          RegExp(
                                                                              r'<[^>]*>|&[^;]+;'),
                                                                          '')
                                                                      .substring(
                                                                          0,
                                                                          150) +
                                                                  '...'
                                                              : blog['content']
                                                                  .replaceAll(
                                                                      RegExp(
                                                                          r'<[^>]*>|&[^;]+;'),
                                                                      ''),
                                                          style:
                                                              const TextStyle(
                                                            color:
                                                                Colors.black54,
                                                            height: 1.5,
                                                          ),
                                                        ),
                                                        const SizedBox(
                                                            height: 16),
                                                        Row(
                                                          children: [
                                                            const Icon(
                                                              Icons
                                                                  .comment_outlined,
                                                              color: Color(
                                                                  0xFF6A1B9A),
                                                              size: 20,
                                                            ),
                                                            const SizedBox(
                                                                width: 4),
                                                            Text(
                                                              '${comments.length} Comments',
                                                              style:
                                                                  const TextStyle(
                                                                color: Color(
                                                                    0xFF6A1B9A),
                                                                fontWeight:
                                                                    FontWeight
                                                                        .bold,
                                                              ),
                                                            ),
                                                            const Spacer(),
                                                            Text(
                                                              'Read More',
                                                              style: TextStyle(
                                                                color: const Color(
                                                                        0xFF6A1B9A)
                                                                    .withOpacity(
                                                                        0.8),
                                                                fontWeight:
                                                                    FontWeight
                                                                        .bold,
                                                              ),
                                                            ),
                                                            const SizedBox(
                                                                width: 4),
                                                            Icon(
                                                              Icons
                                                                  .arrow_forward,
                                                              size: 16,
                                                              color: const Color(
                                                                      0xFF6A1B9A)
                                                                  .withOpacity(
                                                                      0.8),
                                                            ),
                                                          ],
                                                        ),
                                                      ],
                                                    ),
                                                  ),
                                                ],
                                              ),
                                            ),
                                          );
                                        },
                                      ),
                              ),
                            ],
                          ),
                        ),
            ],
          ),
        ),
      ),
    );
  }
}