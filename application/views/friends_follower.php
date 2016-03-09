<div class="friendsFolowerPopup" id="ffPopup">
	<div class="ffContainer">
		<div class="ffContainerBackground"></div>
		<div class="ffPopupContents">
			<div id="tabfriend">
				<ul>
					<li>
						<div class="ffIconText">
							<div class="feedbackColor"></div>
							<a href="#tt1" id="tabf1">
								<div class="tabHeader">
									<div class="friendsIcon"></div>
									<div class="darkText float_left posText">Friends</div>
									<div class="pinkText"><?php echo count($friends); ?></div>
								</div>
							</a></div>
					</li>
					<li>
						<div class="ffIconText">
							<div class="feedbackColor"></div>
							<a href="#tt2" id="tabf2">
								<div class="tabHeader">
									<div class="followersIcon"></div>
									<div class="darkText float_left posText" href="javascript:void(0)">Followers</div>
									<div class="pinkText"><?php echo count($followers); ?></div>
								</div>
							</a></div>
					</li>
					<li>
						<div class="ffIconText">
							<div class="feedbackColor"></div>
							<a href="#tt3" id="tabf3">
								<div class="tabHeader">
									<div class="followingIcon"></div>
									<div class="darkText float_left posText" href="javascript:void(0)">Following</div>
									<div class="pinkText"><?php echo count($followees); ?></div>
								</div>
							</a></div>
					</li>
					<div class="closeIcon ffIcon" id="friendsClose"></div>
					<div class="topDotSeparator"></div>
				</ul>
				<div id="tt1">
					<div class="fftab1Content">
						<div class="fftab1contentBackground"></div>
						<div class="fftab1contents friendsImagesContainer" id="tab1_1">
							<div
								class="fffrow"> <?php for ($i = 0; $i < count($friends); $i++): ?> <?php if ($i % 4 == 0) $cclass = "fffcontainer paddingLeft0"; elseif ($i % 4 == 3) $cclass = "fffcontainer margin_right0"; else $cclass = "fffcontainer"; ?>
									<div class="<?php echo $cclass; ?>">
										<div class="fffTransp"></div>
										<div class="fffMain"><a title="<?php echo $friends[$i]['full_name']; ?>"
										                        href="<?php echo $base_url . 'order/friend_fancy_product/' . $friends[$i]['user_id'] ?>">
												<div
													class="prodBg"> <?php $filename = 'assets/images/users/' . $friends[$i]['user_id'] . '/' . $friends[$i]['user_id'] . '_large.jpg'; if (file_exists($filename)): ?>
														<img
															src="<?php echo $base_url; ?>assets/images/users/<?php echo $friends[$i]['user_id'] . '/' . $friends[$i]['user_id'] . '_large.jpg'; ?>"
															width="60" height="60"/> <?php else: ?> <img
														src="<?php echo $base_url; ?>assets/images/default/defbig.jpg"
														width="60" height="60"/> <?php endif; ?> </div>
											</a>

											<div class="peopleLeft"><a
													href="<?php echo $base_url . 'order/friend_fancy_product/' . $friends[$i]['user_id'] ?>"
													class="peopleName"><?php echo substr($friends[$i]['full_name'], 0, 17); ?></a>

												<div class="peoleCountry"><?php echo $friends[$i]['country']; ?></div>
												<!--<button class="following" type="button">Following</button>-->
												<!--<button class="unfollow" type="button">Unfollow</button>--> </div>
										</div>
									</div> <?php endfor; ?> </div>
						</div>
						<div class="popupslide">
							<div class="slideNormal newmargin"></div>
						</div>
					</div>
				</div>
				<div id="tt2">
					<div class="fftab1Content">
						<div class="fftab1contentBackground"></div>
						<div class="fftab1contents friendsImagesContainer" id="tab2_1">
							<div
								class="fffrow"> <?php for ($i = 0; $i < count($followers); $i++): ?> <?php if ($i % 4 == 0) $cclass = "fffcontainer paddingLeft0"; elseif ($i % 4 == 3) $cclass = "fffcontainer margin_right0"; else $cclass = "fffcontainer"; ?>
									<div class="<?php echo $cclass; ?>">
										<div class="fffTransp"></div>
										<div class="fffMain"><a title="<?php echo $followers[$i]['full_name']; ?>"
										                        href="<?php echo $base_url . 'order/friend_fancy_product/' . $followers[$i]['user_id'] ?>">
												<div
													class="prodBg"> <?php $filename = 'assets/images/users/' . $followers[$i]['user_id'] . '/' . $followers[$i]['user_id'] . '_large.jpg'; if (file_exists($filename)): ?>
														<img
															src="<?php echo $base_url; ?>assets/images/users/<?php echo $followers[$i]['user_id'] . '/' . $followers[$i]['user_id'] . '_large.jpg'; ?>"
															width="60" height="60"/> <?php else: ?> <img
														src="<?php echo $base_url; ?>assets/images/default/defbig.jpg"
														width="60" height="60"/> <?php endif; ?> </div>
											</a>

											<div class="peopleLeft"><a
													href="<?php echo $base_url . 'order/friend_fancy_product/' . $followers[$i]['user_id'] ?>"
													class="peopleName"><?php echo substr($followers[$i]['full_name'], 0, 17); ?></a>

												<div class="peoleCountry"><?php echo $followers[$i]['country']; ?></div>
												<!--<button class="following" type="button">Following</button>-->
												<!--<button class="unfollow" type="button">Unfollow</button>--> </div>
										</div>
									</div> <?php endfor; ?> </div>
						</div>
						<div class="popupslide">
							<div class="slideNormal newmargin"></div>
						</div>
					</div>
				</div>
				<div id="tt3">
					<div class="fftab1Content">
						<div class="fftab1contentBackground"></div>
						<div class="fftab1contents friendsImagesContainer" id="tab3_1">
							<div
								class="fffrow"> <?php for ($i = 0; $i < count($followees); $i++): ?> <?php if ($i % 4 == 0) $cclass = "fffcontainer paddingLeft0"; elseif ($i % 4 == 3) $cclass = "fffcontainer margin_right0"; else $cclass = "fffcontainer"; ?>
									<div class="<?php echo $cclass; ?>">
										<div class="fffTransp"></div>
										<div class="fffMain"><a title="<?php echo $followees[$i]['full_name']; ?>"
										                        href="<?php echo $base_url . 'order/friend_fancy_product/' . $followees[$i]['user_id'] ?>">
												<div
													class="prodBg"> <?php $filename = 'assets/images/users/' . $followees[$i]['user_id'] . '/' . $followees[$i]['user_id'] . '_large.jpg'; if (file_exists($filename)): ?>
														<img
															src="<?php echo $base_url; ?>assets/images/users/<?php echo $followees[$i]['user_id'] . '/' . $followees[$i]['user_id'] . '_large.jpg'; ?>"
															width="60" height="60"/> <?php else: ?> <img
														src="<?php echo $base_url; ?>assets/images/default/defbig.jpg"
														width="60" height="60"/> <?php endif; ?> </div>
											</a>

											<div class="peopleLeft"><a
													href="<?php echo $base_url . 'order/friend_fancy_product/' . $followees[$i]['user_id'] ?>"
													class="peopleName"><?php echo substr($followees[$i]['full_name'], 0, 17); ?></a>

												<div class="peoleCountry"><?php echo $followees[$i]['country']; ?></div>
												<!--<button class="following" type="button">Following</button>-->
												<!--<button class="unfollow" type="button">Unfollow</button>--> </div>
										</div>
									</div> <?php endfor; ?> </div>
						</div>
						<div class="popupslide">
							<div class="slideNormal newmargin"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>